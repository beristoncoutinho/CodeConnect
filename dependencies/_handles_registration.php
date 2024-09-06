<?php
// Used to keep track of user if exists & also to track if registration was successful or failed.
$showAlert = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include './_dbconnect.php';
    $user_name = $_POST['registerUsername'];
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];
    $cpassword = $_POST['registerCpassword'];

    //Checking if the same user with the username is existing in the table..
    $user_exists = "SELECT * FROM `users` WHERE user_name = '$user_name'";
    $result = mysqli_query($conn, $user_exists);
    $numRows = mysqli_fetch_row($result);
    if ($numRows > 0) {
        header("location:/ThreadX/index.php?user_exist=1");
        exit();
    } else {
        if ($password == $cpassword) {
            // creating hash of that password and storring it in the table..
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_name`, `user_email`, `user_password`) VALUES ('$user_name', '$email', '$hash_password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
                // Now redirects the user to the home page i.e index.html
                 // Redirect the user to the home page with the registration success message.
                 header("location:/ThreadX/index.php?register=1");
                 exit();
            } 
            else{
                // Handle if it did'nt get inserted
            }
        }
        else {
            header("location:/ThreadX/index.php?register=2");
            $showAlert = "Passwords don't match!";
            exit();
        }
    }
    // if method was not post then..
    // header("location:/ThreadX/index.php?register=false&error=$showAlert");
}
