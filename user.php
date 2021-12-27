<?php


class User{

    private $errors = array();


    public function signup($POST){

        //print_r($POST);

        //validate
        foreach( $POST as $key => $value)
        {

            //username
            if($key == "username")
            {
                if(trim($value) == "")
                {

                    $this->errors[] = "enter valid username!";
                }
                if(is_numeric($value))
                {

                    $this->errors[] = "Username can not be allowed number.";
                }
                if(preg_match("/[0-9]+/",$value))
                {
                    $this->errors[] = "Username can not contain number.";
                }
            }


            //email
            if($key == "email")
            {
                if(trim($value) == "")
                {

                    $this->errors[] = "enter valid email!";
                }

                if(!filter_var($value,FILTER_VALIDATE_EMAIL))
                {
                    $this->errors[] ="Email is not valid.";
                }
            }

            //password
            if($key == "password")
            {
                //check if its empty
                if(trim($value) == "")
                {

                    $this->errors[] = "enter valid password!";
                }

                //password length
                if(strlen($value) < 4)
                {
                    $this->errors[] ="Password must be at least 4 character long.";
                }
                
            }
        }

        $DB = new Database();
        //check if email already exists
        $data = array();
        $data['email'] = $POST['email'];
        $query = "select * from users where email = :email limit 1";
        $result = $DB->read($query,$data);
        if($result)
        {
            $this->errors[] = "That email is already in use!";
        }


        //save database
        if(count($this->errors) == 0)
        {
            //save

            $query = "insert into users(username,email,password,date) values (:username,:email,:password,:date )";


            $data = array();

            $data['username'] = $POST['username'];
            $data['email'] = $POST['email'];
            $data['password'] = $POST['password'];
            $data['date'] = date("Y-m-d H:i:s");
            
            $result = $DB->write($query,$data);

            if(!$result)
            {
                $this->errors[] ="Your data can not be save into database.";
            }
        }

        return $this->errors;
    }
}