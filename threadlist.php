<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS file for nav bar etc -->
  <link rel="stylesheet" href="home.css">
  <!-- Css file which controls the jumbotron container,add question modal etc -->
  <link rel="stylesheet" href="dependencies.css">
  <!-- Sweet alert dependency -->
  <script src="js/popup.js"></script>
  <link rel="stylesheet" href="./comment_and_question_container.css">
  <!-- css for qustion container ->thread_title -->
  <style>
    .thread-title {
      color: black;
      text-decoration: underline;
      font-weight: bold;
    }

    /* css for no comments-container(no questions) */
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
  </style>
  <title>CodeConnect</title>
</head>

<body>
  <!-- header  -->
  <?php include 'dependencies/_nav.php'; ?>
  <!-- Connection  -->
  <?php include 'dependencies/_dbconnect.php'; ?>

  <!-- Now pulling the community id which user clicks -->
  <?php
  $id = $_GET['com_id'];
  $sql = "SELECT * FROM `communities` WHERE community_id=$id";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $community_name = $row['community_name'];
    $community_desc = $row['community_desc'];
    $community_image = $row['community_image'];
  }
  ?>
  <!-- inserting data into the database -->
  <?php
  $method = $_SERVER['REQUEST_METHOD'];
  if ($method == "POST") {
    $thread_title = $_POST['question-title'];
    $thread_desc = $_POST['question-description'];
    //id => com_id which we have passed in the URL
    $id = $_GET['com_id'];
    $user_id = $_POST['user_no'];
    $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_community_id`, `thread_user_id`) VALUES ('$thread_title', '$thread_desc', '$id', '$user_id')";

    $result = mysqli_query($conn, $sql);
    $success = false;
    if ($result) {
      echo '<script>
      Swal.fire({
          title: "Success!",
          text: "Your Question has been added!",
          icon: "success",
          confirmButtonText: "OK"
      });
    </script>';
    }
  }
  ?>

  <!-- Jumbotron Section -->
  <div class="jumbotron">
    <div class="container-fluid">
      <div class="row">
        <div class="row-content">
          <h3>Welcome to <?php echo $community_name; ?></h3>
          <p class="title-description"><?php echo $community_desc; ?></p>
        </div>
        <img class="community-img" src="<?php echo $community_image; ?>.png" alt="Community Image">
      </div>
    </div>
  </div>
  <?php
  // Ask Question Modal....
  echo '<div id="myModal" class="modal">
        <div class="modal-content">
            <form action="' . $_SERVER['REQUEST_URI'] . '" id="question-form" method="post">
                <h2 class="heading-add-question">Ask Your Question</h2>
                <input type="hidden" name="user_no" value="' . $_SESSION["user_no"] . '">
                <div class="form-group">
                    <label for="questionTitle" class="label-question-title">Question Title:</label>
                    <input type="text" id="questionTitle" name="question-title" required>
                </div>
                <div class="form-group">
                    <label for="questionDescription" class="label-question-title">Question Description:</label>
                    <textarea id="questionDescription" name="question-description" rows="4" required></textarea>
                </div>
                <div class="button-group">
                    <button id="cancelBtn" class="btn cancel">Cancel</button>
                    <button type="submit" id="submitBtn" class="btn">Submit</button>
                </div>
            </form>
        </div>
    </div>';
  ?>

  <!-- Browser Questions -->
  <div class="browse-questions">
    <h2>Browse for Questions</h2>
    <?php
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
      echo '<button type="button" class="ask-question" id="openModalBtn">Ask a question</button>';
    } else {
      echo '<button type="button" class="ask-question" id="openModalBtn" disabled>Ask a question</button>';
    }
    ?>
  </div>
  <?php 
  if(!isset($_SESSION['logged_in']) && !($_SESSION['logged_in'] == true)){
    echo '<div class="no-comments">Please login to ask your question!</div>';
  }
  ?>
  <?php
  // Displaying the questions related to the ID.
  $id = $_GET['com_id'];
  $sql = "SELECT * FROM `threads` WHERE thread_community_id=$id";
  $result = mysqli_query($conn, $sql);
  $no_questions = true;
  while ($row = mysqli_fetch_assoc($result)) {
    $no_questions = false;
    $thread_id = $row['thread_id'];
    $thread_title = $row['thread_title'];
    $thread_desc = $row['thread_desc'];
    // As you want the name of the user.
    $thread_user_id = $row['thread_user_id'];
    $timestamp = $row['timestamp'];

    $display_user_sql = "SELECT user_name FROM `users` WHERE user_no='$thread_user_id'";
    $display_user_result = mysqli_query($conn, $display_user_sql);
    $display_user_row = mysqli_fetch_assoc($display_user_result);
    echo '<div class="comment-container">
      <div class="image-container">
          <img class="avtar" src="img/avtar.png" alt="User Avatar">
      </div>
      <div class="comment-content">
          <p class="name-date"><b>' . $display_user_row['user_name'] . '</b>&ensp; <img  style="width: 20px;" class="date-time" src="img/date_time.png" alt=""><span id="comment-date-time">' . $timestamp . '</span></p>
          <a class="thread-title" href="comment.php?thread_id=' . $thread_id . '">' . $thread_title . '</a>
      </div>
  </div>';
  }
  if ($no_questions) {
    echo '<div class="no-comments">No Question Found!</div>';
  }
  ?>
  <!-- login modal -->
  <?php include 'dependencies/_login_modal.php' ?>
  <!-- registration Modal -->
  <?php include 'dependencies/_registration_modal.php' ?>
  <!-- Js code done by MR. Beriston Coutinho  -->
  <script src="js/login_modal.js"></script>
  <script src="js/registration_modal.js"></script>
  <!-- Footer -->
  <?php include 'dependencies/_footer.php' ?>
  <!-- ---------------------- Script for opening modal--------------------------------- -->
  <script>
    // Get the modal and buttons
    const ask_question_modal = document.getElementById("myModal");
    const openModalBtn = document.getElementById("openModalBtn");
    const cancelBtn = document.getElementById("cancelBtn");

    // Open the modal when the "Open Modal" button is clicked
    openModalBtn.addEventListener("click", () => {
      ask_question_modal.style.display = "block";
    });

    // Close the modal when the "Cancel" button or overlay is clicked
    cancelBtn.addEventListener("click", () => {
      ask_question_modal.style.display = "none";
    });

    // Close the modal when the user clicks outside of it
    window.addEventListener("click", (event) => {
      if (event.target === ask_question_modal) {
        ask_question_modal.style.display = "none";
      }
    });
  </script>
  <!--  Script Ends for opening modal modal-- -->
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