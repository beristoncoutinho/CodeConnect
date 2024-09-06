<!-- handling if user logins -->
<?php
$showAlert = false;
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include './_dbconnect.php';
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];
    $sql = "SELECT * FROM `users` WHERE user_name = '$username'";
    $result = mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($result);
    if($numRows == 1){
        // now fetching the assoc row whose username matches..
        $row = mysqli_fetch_assoc($result);
        // Now verifying the current password with the database pass..
        if(password_verify($password,$row['user_password'])){
            session_start();
            $_SESSION['logged_in'] = true;
            // For displaying names when user raises question or replying to someone's query.
            $_SESSION['user_no'] = $row['user_no'];
            $_SESSION['user_name'] = $row['user_name'];
            // on sucessful login
            header("location:/ThreadX/index.php?login=1");
            exit();
        }
        else{
            // if password is not matching
            header("location:/ThreadX/index.php?login=2");
            exit();
        }
        // Redirecting the user to the home page
        header("location:/ThreadX/index.php");
        exit();
    }
    else{
        // handle this if user does'nt exits
        header("location:/ThreadX/index.php?login=3");
        exit();
    }
}
?>
