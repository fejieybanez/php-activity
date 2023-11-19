<!-- User Profile Page PHP File

In this step, you need to create a new file name dashboard.php and update the below code into your file.
The below code used to show logged in user data. -->

<?php
   session_start();
    
   if(isset($_SESSION['user_id']) =="") {
       header("Location: login.php");
   }
    
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>User Info Dashboard | Tutsmake.com</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
      <style>
         .btn-primary{
            background-color: rgb(236, 184, 12);
            border: none;
            outline: none;
         }
         .btn-primary:hover{
            background-color: rgb(206, 144, 12);;
         }
      </style>
   </head>
   <body>
      <div class="container">
         <div class="row">
            <div class="col-lg-8">
               <div class="card">
                  <div class="card-body">
                     <h5 class="card-title">Name :- <?php echo $_SESSION['user_name']?></h5>
                     <p class="card-text">Email :- <?php echo $_SESSION['user_email']?></p>
                     <a href="logout.php" class="btn btn-primary">Logout</a> 
                  </div>
               </div>
            </div>
         </div>
         </div>
   </body>
</html>