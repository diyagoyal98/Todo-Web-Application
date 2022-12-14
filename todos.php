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
            <h1 class="mb-4 text-center fw-bold">Your Todos</h1>
                <div class="row">
                <?php
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
                    $sql1 = "SELECT * FROM todos WHERE user_id='{$user_id}' ORDER BY id DESC";
                    $res1 = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($res1) > 0) 
                    {
                      foreach ($res1 as $todo) 
                      {
                ?>        
                  <div class="col-lg-3 col-md-6 mb-4">
                    <?php gettodo($todo);  ?>  
                    
                  </div>
                  <?php   }} else {  echo "<h1 class='text-danger text-center fw-bold'>Nothing to show !!</h1>"; }?>
                </div>
          </div>
    </div>  
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  

</body>
</html>

