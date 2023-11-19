<!-- Create Simple Login Form In PHP

In this step, you need to create a form, where you accept user email id and password. So you can create a login.php file and update the below code into your file.
The below code is used to show login form and authenticate the user from MySQL database in PHP. -->

<?php
session_start();
 
require_once "db.php";
 
if (isset($_SESSION['user_id']) != "") {
    header("Location: dashboard.php");
}
 
if (isset($_POST['login'])) { //if form login is submitted. Post is used to send data to the server for processing
    $email    = mysqli_real_escape_string($conn, $_POST['email']); // escape string is used to prevent sql injection(SQL Injection (SQLi) is a type of an injection attack that makes it possible to execute malicious SQL statements)
    $password = mysqli_real_escape_string($conn, $_POST['password']);
     
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Please Enter Valid Email ID";
    }
    if (strlen($password) < 6) {
        $password_error = "Password must be minimum of 6 characters";
    }
     
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email . "' and password = '" . md5($password) . "'");
    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['user_id']     = $row['uid'];
        $_SESSION['user_name']   = $row['name'];
      //   $_SESSION['user_mobile'] = $row['mobile'];
        $_SESSION['user_email']  = $row['email'];
        header("Location: dashboard.php");
    } else {
        $error_message = "Incorrect Email or Password!!!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Login</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

   </head>
   <body>
      <div class="wrapper">
         <div class="row">
            <div class="col-lg-10">
               <div class="page-header">
                  <h2>Login</h2>
               </div>
               <p>Please fill all fields in the form</p>
               <span class="text-danger"><?php if (isset($error_message)) echo $error_message; ?></span>
               <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                 <div class="input-box">
                 <input type="email" name="email" class="form-control" value="" maxlength="30" placeholder="Email"required="">
                               <i class='bx bxs-user'></i>
                     <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                  </div>
                  <div class="input-box">
                  <input type="password" name="password" class="form-control" value="" maxlength="8" placeholder= "Password" required="">
                           <i class='bx bxs-lock-alt' ></i>
                         <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                  </div>
                  <input type="submit" class="btn btn-primary" name="login" value="Submit">
                  <br>
                         Don't have an account?<a href="registration.php" class="mt-3"> Register</a>
               </form>
            </div>
         </div>
         </div>
   </body>
</html>