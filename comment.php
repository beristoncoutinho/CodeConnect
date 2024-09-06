<!-- This controls adding suggestion to individuals Questions -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeConnect</title>
    <!-- CSS file for nav bar etc -->
    <link rel="stylesheet" href="home.css">
    <!-- Css file which controls the jumbotron container,add question modal etc -->
    <link rel="stylesheet" href="dependencies.css">
    <!-- Sweet alert dependency -->
    <script src="js/popup.js"></script>
    <!-- Css code for comment container -->
    <link rel="stylesheet" href="./comment_and_question_container.css">
    <!-- Css -->
    <style>
        /* css for no comments-container */
        .no-comments {
            font-weight: bolder;
            font-size: larger;
            border: 2px solid #8e92ca;
            height: 20vh;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background-color: #abc4f0;
            margin: 10px 10px 10px 10px;
        }

        .title-description {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            max-width: 100%;
            max-height: 100%;
        }

        .community-rules {
            /* border: 2px solid #2b0497; */
            border-radius: 10px;
            padding: 10px;
            margin-top: 10px;
            background: #a7cdf7;
            margin-bottom: 20px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        .jumbotron {
            background-color: #d8e7ff;
            border-radius: 15px;
            padding: 20px;
        }

        .posted-details {
            display: flex;
            justify-content: space-between;
        }

        .row-content {
            margin-top: 10px;
        }

        /* -----------Writting the CSS for posting comment container------------ */
        /* Style for the comment container */
        .post-comment-container {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Style for the "Post a Comment" header */
        .post-header {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Style for the comment textarea */
        .inputComment {
            width: 99%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
            margin-bottom: 10px;
            margin-top: 10px;
            font-size: larger;
        }


        /* Style for the "Post Comment" button */
        .btnComment {
            background-color: #15359f;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btnComment:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <!-- header  -->
    <?php include 'dependencies/_nav.php' ?>
    <!-- login modal -->
    <?php include 'dependencies/_login_modal.php' ?>
    <!-- registration Modal -->
    <?php include 'dependencies/_registration_modal.php' ?>
    <!-- Connection  -->
    <?php include 'dependencies/_dbconnect.php' ?>
    <?php
    // Grabbing the threadid which passed in the thread link itself on clicking..
    $id = $_GET['thread_id'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $posted_on = $row['timestamp'];
        // It should display the name of the person who posted the comment...
       $thread_user_id = $row['thread_user_id'];
       $Question_user_sql = "SELECT * FROM `users` WHERE user_no='$thread_user_id'";
       $Question_user_result = mysqli_query($conn,$Question_user_sql);
       $Question_user_row = mysqli_fetch_assoc($Question_user_result);
       $posted_by = $Question_user_row['user_name'];

    }
    ?>
    <!-- handling the post Comment Inserting Request -->
    <?php
    $comment_flag = false;
    $comment_request_method = $_SERVER['REQUEST_METHOD'];
    if ($comment_request_method == "POST") {
        $comment = $_POST['inputComment'];
        // Grabbing from the url
        $thread_id = $_GET['thread_id'];
        // Now grabbing the user_no which was sended through post
        $commented_by = $_POST['user_no'];
        $sql = "INSERT INTO `comments` ( `comment_desc`, `commented_by`,`thread_id`) VALUES ('$comment', '$commented_by', '$thread_id')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $comment_flag = true;
            if ($comment_flag) {
                // Handle this by Displaying Sweet Alert.
                echo '<script>
                Swal.fire({
                    title: "Success!",
                    text: "Your Comment has been recorded!",
                    icon: "success",
                    confirmButtonText: "OK"
                });
                </script>';
            }
        }
    }
    ?>

    <!-- Jumbotron Section -->
    <div class="jumbotron">
        <div class="container-fluid">
            <div class="row">
                <div class="row-content">
                    <h3>
                        <?php echo $title; ?>
                    </h3>
                    <p class="title-description">
                        <?php echo $desc ?>
                    </p>
                </div>
            </div>
        </div>
        <p class="community-rules">"Our forum community values respectful and meaningful engagement. We kindly request
            our users to refrain from spamming, which includes posting repetitive or irrelevant content. Respectful
            communication is of utmost importance; please treat fellow members with courtesy and refrain from personal
            attacks or offensive language. To keep discussions organized, we ask that you stay on topic within the
            relevant category. Unauthorized advertising or excessive self-promotion is not allowed without prior
            approval. Before creating a new thread, check for similar topics to avoid duplicates. When posting, use
            clear and descriptive titles. We prioritize privacy and discourage sharing personal information without
            consent. If you encounter suspicious content, please report it, and remember to follow our community
            guidelines."</p>
        <div class="posted-details">
            <div class="posted-by">Posted By:<?php echo  $posted_by; ?></div>
            <div class="posted-time">Posted on: <?php echo $posted_on;  ?></div>
        </div>
    </div>
    <!-- if user is logged in then only he can post a comment. -->
    <?php
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        echo '<div class="post-comment-container">
             <div class="post-header">Post a Comment</div>
             <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                <input type="hidden" name="user_no" value="' . $_SESSION["user_no"] . '">
                 <label for="inputComment">Type your comment</label>
                 <textarea name="inputComment" id="inputComment" class="inputComment" cols="5" rows="5"></textarea>
                 <button class="btnComment" type="submit">Post Comment</button>
             </form>
         </div>';
    } else {
        // show some bxo that no question found.. or no comments found
        echo  '<div class="no-questions">You are Not logged in!</div>';
    }
    ?>
    <!-- -------------------These are comments-------------------- -->
    <div class="browse-questions">
        <h2>Comments</h2>
    </div>
    <!-- Browsing comments -->
    <?php
    // Displaying all the comments
    $thread_id = $_GET['thread_id'];
    $display_comments = "SELECT * FROM `comments` WHERE thread_id=$thread_id";
    $result = mysqli_query($conn, $display_comments);
    // Checking if there are comments or not... If not then Display a conatinner..
    $no_comments = true;
    while ($row = mysqli_fetch_assoc($result)) {
        $no_comments = false;
        $comment_id = $row['comment_id'];
        $comment_desc = $row['comment_desc'];
        $commented_time = $row['commented_time'];
        // used to set the name of user in comment.
        $commented_by = $row['commented_by'];
        $display_user = "SELECT user_name FROM `users` WHERE user_no = '$commented_by'";
        $display_result = mysqli_query($conn, $display_user);
        $display_row = mysqli_fetch_assoc($display_result);
        echo ' <div class="comment-container">
                    <div class="image-container">
                        <img class="avtar" src="img/avtar.png" alt="User Avatar">
                    </div>
                    <div class="comment-content">
                        <p class="name-date"><b>' . $display_row['user_name'] . '</b>&ensp; <img  style="width: 20px;" class="date-time" src="img/date_time.png" alt=""><span id="comment-date-time">' . $commented_time . '</span></p>
                       ' . $comment_desc . '
                    </div>
                </div>';
    }
    if ($no_comments) {
        echo '<div class="no-comments">No Comments Found!</div>';
    }
    ?>

    <!-- Footer -->
    <?php include 'dependencies/_footer.php' ?>

    <!-- Js code done by MR. Beriston Coutinho  -->
    <script src="js/login_modal.js"></script>
    <script src="js/registration_modal.js"></script>
    <!-- Script for preventing form resubmition when user reloads the page. -->
    <script>
        // Prevent form resubmission on page refresh
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.querySelector("form");
            form.reset();
        });
    </script>

</body>

</html>