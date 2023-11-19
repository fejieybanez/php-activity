<!-- Create a Database Connection File
In this step, you need to create a file name db.php and update the below code into your file.
The below code is used to create a MySQL database connection in PHP. When you need to insert form data into MySQL database, there you will include this file: -->

<?php
    $servername='localhost';
    $username='root';
    $password='123123qwertyqwerty';
    $dbname = "activitydb";

    $conn=mysqli_connect($servername,$username,$password,"$dbname"); //this creates a connection to my database using the mysqli_connect

      if(!$conn){ //if the connection is false or unsuccessful. it will display an error message nga Could not connect to mysql server
          die('Could not Connect MySql Server:' .mysqli_connect_error());
        }

?>