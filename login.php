<?php

include "includes/config.php";
session_start();

if(isset($_SESSION["user_email"]))
{
    header("Location: todos.php");
    die();
}

if(isset($_POST["submit"]))
{
    $email=mysqli_real_escape_string($conn,$_POST["email"]);
    $password=mysqli_real_escape_string($conn,md5($_POST["password"]));
    

    if(emailisvalid($email)) // through  this we have checked that is the email already exists
    {
        //echo "user is valid";
        //As email exists so now we are checking the login credentials i.e email and password
        if(checklofindetails($email,$password))
        {
            //echo "login details true";
            $_SESSION["user_email"]=$email; 
            header("Location:todos.php ");
            die();
        } 
        else
        {
            echo "<script> alert('Login details are invalid'); window.location.replace('index.php') </script>";
        }

    }
    else
    {
        //echo "user is not valid";
        $user_regestration=createuser($email,$password);
        if($user_regestration)
        {
            echo "<script> alert('new user yipeeeeeeeeeeeeeeeeeeeeee'); </script>";
            $_SESSION["user_email"]=$email;
            header("Location:todos.php ");
            die();
        }
        else
        {
            echo "user regestration fail";
            die();
        }
    }
}
else
{
    header("Location: index.php");
    die();
}