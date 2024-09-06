<?php
// Now handling the navbar if the user is logged in and logged out
session_start();
echo '<header>
        <nav class="navbar">
            <div class="left-nav">
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about_us.php">About Us</a></li>
                    <li><a href="terms_conditions.php">Terms & Conditions</a></li>
                </ul>
            </div>
            <div class="right-nav">
                <form action="searching_threads.php" method="get">
                    <div class="search">
                        <input type="search" name="search" id="search" placeholder="Search">
                        <button type="submit"><img src="img/search.jpeg"></button>
                    </div>
                </form>';
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
                 echo '<div class="profile-name">
                        <a href="#"><img src="img/avtar.png" alt="Avatar"> 
                         <div class="user-name">'.$_SESSION['user_name'].'</div>
                        </a>
                      </div>';
                echo '<a href="dependencies/_handles_logout.php"><input type="button" id="LogoutButton" value="Logout"/></a>';
            }else{
               echo '<div class="login">
                <input type="button" id="loginButton" value="Login">
                <input type="button" id="RegisterButton" value="Register">
                </div>';
            }
         
     echo '</div>
        </nav>
  </header>';
?>
