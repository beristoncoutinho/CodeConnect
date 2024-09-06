<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Results</title>
    <!-- CSS file for nav bar etc -->
    <link rel="stylesheet" href="comment_and_question_container.css">
    <link rel="stylesheet" href="home.css">
    <style>
        footer{
            margin-top: 59vh;
        }
        .thread-title {
            color: black;
            text-decoration: underline;
        }

        /* css for no searches */
        .no-search-results {
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

        .jumbotron {
            margin-top: 80px;
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

        .title-description {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>

<body>
    <!-- Connection  -->
    <?php include 'dependencies/_dbconnect.php'; ?>
    <!-- Header Navbar -->
    <?php include 'dependencies/_nav.php'; ?>
    <?php
    // Grabbing the query
    $query = $_GET['search'];

    echo  '<div class="jumbotron">
                <div class="container-fluid">
                    <div class="row">
                        <div class="row-content">
                        <h1>Searching Results for "' . $query . '"</h1>
                        </div>
                    </div>
                </div>';
    // counter variable for checking if search result exists or no....
    $no_search_result = true;
    $sql = "SELECT * from `threads` where match (thread_title, thread_desc) against ('$query')";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $thread_id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];
        $timestamp = $row['timestamp'];
        // It will take the user to the corresponding thread
        $url = "comment.php?thread_id=" . $thread_id;
        $no_search_result = false;
        // Now fetching the commented user
        $fetch_user = "SELECT user_name FROM `users` WHERE user_no = '$thread_user_id'";
        $fetch_user_result = mysqli_query($conn,$fetch_user);
        $fetch_assoc_user = mysqli_fetch_assoc($fetch_user_result);
        $user_name = $fetch_assoc_user['user_name'];
        // <!-- Display search Results-->
     echo '<div class="comment-container">
                <div class="image-container">
                    <img class="avtar" src="img/avtar.png" alt="User Avatar">
                </div>
                <div class="comment-content">
                    <p class="name-date">Posted By:&nbsp;<b>'.$user_name.'</b>&emsp;Posted on:&nbsp; <img style="width: 20px;" class="date-time" src="img/date_time.png" alt=""><span id="comment-date-time">'.$timestamp.'</span></p>
                    <a class="thread-title" href="'.$url.'"><b>'.$title.'</b></a>
                </div>
            </div>';
    }
    echo  '</div>';
    ?>
    <?php
    // if there are no search match then it will show this...
    if ($no_search_result) {
        // Handle this if no results..
        echo  '<div class="no-search-results">No search results found!</div>';
    }
    ?>

    <!-- Footer -->
    <?php include 'dependencies/_footer.php'; ?>
</body>

</html>