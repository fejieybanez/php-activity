<?php
session_start();

require_once "db.php";

if (isset($_SESSION['user_id']) != "") {
    header("Location: dashboard.php");
}

if (isset($_POST['register'])) {
    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Please Enter Valid Email ID";
    }

    if (strlen($password) < 6) {
        $password_error = "Password must be a minimum of 6 characters";
    }

    // Check if the email is already registered
    $check_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check_email) > 0) {
        $email_error = "Email already exists. Please choose another.";
    } else {
        $hashed_password = md5($password); //md5 message digest algo
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['user_id']     = mysqli_insert_id($conn);
            $_SESSION['user_name']   = $name;
            $_SESSION['user_email']  = $email;
            header("Location: dashboard.php");
        } else {
            $error_message = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="wrapper">
    <div class="row">
        <div class="col-lg-10">
            <div class="page-header">
                <h2>Registration</h2>
            </div>
            <p>Please fill all fields in the form</p>
            <span class="text-danger"><?php if (isset($error_message)) echo $error_message; ?></span>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="input-box">
                    <input type="text" name="name" class="form-control" value="<?php if(isset($name)) echo $name; ?>" maxlength="50" placeholder="Name" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" class="form-control" value="<?php if(isset($email)) echo $email; ?>" maxlength="30" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                    <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                </div>
                <div class="input-box">
                    <input type="password" name="password" class="form-control" value="" maxlength="8" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                    <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                </div>
                <input type="submit" class="btn btn-primary" name="register" value="Register">
                <br>
                Already have an account? <a href="login.php" class="mt-3">Login Here</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
