<?php 

    //set default values
    $username="";
    $email  ="";
    $password = "";

    if(count($_POST) > 0)
    {
        require "autoload.php";

        $User = new User();

        $errors = $User->signup($_POST);


        if(count($errors)  == 0)
        {
            header("Location:profile.php");
            die;
        }

        extract($_POST);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation</title>

    <style>
        .textbox{
            margin:5px;width:95%;padding:10px;outline:none;border-radius:4px;border:solid thin #aaa;
        }

        .submit-btn{
            float:right;
            padding:10px;
            background:lightblue;
            color:#fff;
            border:solid thin lightblue;
            border-radius:4px;
            font-size:16px;
            font-weight:bold;
            margin-top:10px;
            cursor:pointer;
        }

        .error{
            background-color:orange;
            color:white;
            text-align:center;
        }
    </style>
</head>
<body>
    
    <form method="post" style="border:solid thin #aaa;margin:auto;border-radius:5px;width:50%;padding:10px;">

        <?php  
            if(isset($errors) && is_array($errors) && count($errors) > 0 ):
        ?>

        <div class="error">
            <?php foreach($errors as $error): ?>
            <?=$error?><br>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <h3>Signup</h3>
        <input class="textbox" type="text" value="<?=$username?>" name= "username" placeholder="Enter username"  autofocus   ><br>
        <input class="textbox" type="text" value="<?=$email?>" name= "email" placeholder="Enter email"  ><br>
        <input class="textbox" type="password" value="<?=$password?>" name= "password" placeholder="Enter password"  ><br>

        <input type="submit" value="submit" class="submit-btn">

        <br style="clear:both;" />
    </form>
</body>
</html>