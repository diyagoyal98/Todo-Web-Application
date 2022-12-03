<?php

/*DATABASE CONNECTION FUNCTION*/
function dbconnect()
{
    $hostname="localhost";
    $username="root";
    $password="";
    $database="todo_list";
    $conn=mysqli_connect($hostname,$username,$password,$database) or die("Data bse connection falied");

    return $conn;
}

$conn=dbconnect();  

/*TO CHECK IF THE MAIL IS ALREADY ELXISTS OR NOT*/
function emailisvalid($email)
{
    $conn=dbconnect();
    $sql="SELECT email FROM users WHERE email='$email'";
    $result=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($result);

    if($count > 0)
    return true;
    else
    return false;
}

/*TO CHECK IF THE MAIL AND PASSWORD IS CORRECT OR NOT*/
function checklofindetails($email,$password)
{
    $conn=dbconnect();
    $sql="SELECT email FROM users WHERE email='$email' AND password='$password' ";
    $result=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($result);

    if($count > 0)
    return true;
    else
    return false;
}

/*CREATE NEW USER*/
function createuser($email,$password)
{
    $conn=dbconnect();
    $sql="INSERT INTO users (email,password) VALUES('$email','$password')";
    $result=mysqli_query($conn,$sql);

    return $result;
}

function gethead()
{
    $output='<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>To DO LIST </title>

    <!-- Bootstrap css  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>';

    echo $output;
}


function getheader()
{
    $output='<header class="py-3 mb-4 border-bottom bg-white">
    <div class="d-flex flex-wrap justify-content-center container">
      <a href="todos.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
          <span class="fs-4">Todo List</span>
      </a>

      <ul class="nav nav-pills">
          <li class="nav-item"><a href="todos.php" class="nav-link active" aria-current="page">Home</a></li>
          <li class="nav-item"><a href="add_to_do.php" class="nav-link text-dark">Add to do</a></li>
          <li class="nav-item"><a href="logout.php" class="nav-link bg-danger text-white">Log out</a></li>
      </ul>
    </div>
  </header>';

    echo $output;
}


