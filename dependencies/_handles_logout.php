<?php
session_start();

// Destroying all the session variables 
session_destroy();
// Your are redirecting to the home page
header("location:/ThreadX/index.php?login=4");


?>