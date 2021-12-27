<?php

class Database{
     
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db_name = "myusers";

    private function connect()
    {
        $string = "mysql:host=$this->host;dbname=$this->db_name";

        try{

            $con = new PDO($string,$this->user,$this->pass);

        }catch(PDOException $e){

            die($e->getMessage());
        }


        return $con;
    }
    public function write($query,$data = array())
    {
        $con = $this->connect();

        $stmt = $con->prepare($query);
        $result = $stmt->execute($data);

        if($result)
        {
            return true;
        }else{
            return false;
        }
        
    }
    public function read($query,$data = array())
    {
        $con = $this->connect();

        $stmt = $con->prepare($query);
        $result = $stmt->execute($data);

        if($result)
        {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(array($data) && count($data) > 0)
            {
                return $data;
            }
        }

        return false;
        
    }
}