<?php
include "includes/config.php";
session_start();

if(!isset($_SESSION["user_email"]))
{
    header("Location: index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php gethead() ?>
  </head>

  <body>
  
    <?php getheader();?>

    <div class="col">
          <div class="container">
                <div class="row">
                <?php
                    $todoid=mysqli_real_escape_string($conn,$_GET["id"]);
                    $sql="SELECT id FROM users WHERE email='{$_SESSION["user_email"]}'";
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);
                    if ($count > 0) 
                    {
                      $row = mysqli_fetch_assoc($res);
                      $user_id = $row["id"];
                    } 
                    else 
                    {
                        $user_id = 0;
                    }
                    $sql1 = "SELECT * FROM todos WHERE id='$todoid' AND user_id='{$user_id}' ";
                    $res1 = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($res1) > 0) 
                    {
                       
                      foreach ($res1 as $todo) 
                      {
                ?>        
                <main>
                    <h1><?php echo $todo["title"];?></h1>
                    <p class="fs-5 col-md-8"><?php echo $todo["description"];?></p>
                    <div class="mb-5">
                        <a href="<?php echo 'edittodo.php?id='.$todo['id'].''   ?>" class="btn btn-primary btn-lg px-4 me-2">Edit</a>
                        <a href="<?php echo 'deletetodo.php?id='.$todo['id'].''   ?>"" class="btn btn-danger btn-lg px-4">Delete</a>
                    </div>
                </main>  
                  <?php   }} else {
                header("Location: todos.php");
                die();} ?>
                </div>
          </div>
    </div>  
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  

</body>
</html>

