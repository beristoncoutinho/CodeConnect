<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeConnect</title>
    <link rel="stylesheet" href="home.css">
    <script src="js/lottie.min.js"></script>
    <!-- Sweet alert dependency -->
    <script src="js/popup.js"></script>
</head>

<body>
    <!-- Connection  -->
    <?php include 'dependencies/_dbconnect.php' ?>
    <!-- Header Navbar -->
    <?php include 'dependencies/_nav.php' ?>
    <!-- Welcome container -->
    <div class="welcome-container">
        <div class="welcome-content">
            <p class="welcome-title">Welcome to CodeConnect.<br>"Where Ideas Meet and Minds Connect"</hp>
        </div>
        <img src="img/welcome-img.png" alt="...">
    </div>

    <!-- Banner  -->
    <div class="banner">
        <img src="Banner.jpg" style="width: 100vw;height: 50vh;">
    </div>

    <!-- Cards Container -->
    <div class="card-container">
        <!-- fetch all the cards from the db => communities -->
        <?php
        $sql = "SELECT * FROM `communities` ";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $community_id = $row['community_id'];
            $community_name = $row['community_name'];
            $community_desc = $row['community_desc'];

            echo '<a href="threadlist.php?com_id=' . $community_id . '">
                    <div class="card">
                    <div class="img">
                        <div class="animation-container' . $community_id . '"></div>
                        <h1>' . $community_name . '</h1>
                        <p>' .  $community_desc . '</p>
                    </div>
                    </div>
                </a>';
        }
        ?>
        <!-- Showing Sweet Alert on user Registration and login -->
        <?php
        //Registeration Handling of Sweet Alert
        $user_exists = isset($_GET['user_exist']) ? (int)$_GET['user_exist'] : 0;
        $register = isset($_GET['register']) ? (int)$_GET['register'] : 0;

        if ($register == 1) {
            echo '<script>
        Swal.fire({
            title: "Success!",
            text: "Your account has been created!",
            icon: "success",
            confirmButtonText: "OK"
        });
        </script>';
        echo '<script>
        history.replaceState({}, document.title, window.location.pathname);
      </script>';
        } elseif ($user_exists == 1) {
            echo '<script>
                Swal.fire({
                    title: "Error!",
                    text: "User already exists with the same username!",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            </script>';
            echo '<script>
            history.replaceState({}, document.title, window.location.pathname);
          </script>';
        } elseif ($register == 2) {
            echo '<script>
                Swal.fire({
                    title: "Error!",
                    text: "Passwords don\'t match!",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            </script>';
            echo '<script>
            history.replaceState({}, document.title, window.location.pathname);
          </script>';
        }
        ?>
        <?php
        // Login Handling of Sweet Alert
        $login = isset($_GET['login']) ? (int)$_GET['login'] : 0;
        if ($login == 1) {
            $_SESSION['login'] = true;
            echo '<script>
            Swal.fire({
                title: "Hurray!",
                text: "You have been logged in!",
                icon: "success",
                confirmButtonText: "OK"
            });
           </script>';
           echo '<script>
           history.replaceState({}, document.title, window.location.pathname);
         </script>';
        } else if ($login == 2) {
            $_SESSION['login_password_missmatch'] = true;
            echo '<script>
            Swal.fire({
                title: "Login Failed!",
                text: "Password does\'nt match!",
                icon: "error",
                confirmButtonText: "OK"
            });
           </script>';
          // Remove the URL parameters from the current URL
            echo '<script>
            history.replaceState({}, document.title, window.location.pathname);
           </script>';
        } else if ($login == 3) {
            $_SESSION['login_user_not_exist'] = true;
            echo '<script>
            Swal.fire({
                title: "Login Failed!",
                text: "Username does\'nt exists!",
                icon: "error",
                confirmButtonText: "OK"
            });
           </script>';
            echo '<script>
                   history.replaceState({}, document.title, window.location.pathname);
                 </script>';
        } else if ($login == 4) {
            // Logout
            echo '<script>
            Swal.fire({
                title: "Logged Out!",
                text: "You have been logged out!",
                icon: "warning",
                confirmButtonText: "OK"
            });
           </script>';
           echo '<script>
           history.replaceState({}, document.title, window.location.pathname);
         </script>';
        }
        ?>
    </div>
    <!-- Footer -->
    <?php include 'dependencies/_footer.php' ?>
    <!-- login modal -->
    <?php include 'dependencies/_login_modal.php' ?>
    <!-- registration Modal -->
    <?php include 'dependencies/_registration_modal.php' ?>
    <!-- Js code done by MR. Beriston Coutinho  -->
    <script src="js/login_modal.js"></script>
    <script src="js/registration_modal.js"></script>
    <script src="js/lottie_animation.js"></script>
    <!-- Default animation dependency -->
    <script src="Lottie-Windows-main/"></script>
</body>

</html>