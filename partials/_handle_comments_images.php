<?php
session_start();
// including the database connection
include "_db_connect.php";
$showError = false;
$showAlert = false;

// checking if the user is logged in or not
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $username = $_SESSION['username'];

    $sql = "SELECT * FROM `users` WHERE `user_username` = '$username'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
}
if(isset($_GET['image_id'])){
    $image_id = $_GET['image_id'];
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $comment_content = $_POST['comment'];

    $sql = "INSERT INTO `comments_images` (`comment_content`, `image_id`, `user_id`, `timestamp`) VALUES ('$comment_content', '$image_id', '$user_id', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        $showError = "Comment not posted due to some issues";
        header("location: /blog/image_post.php?image_id=$image_id&err=$showError");
    }
    else{
        $showAlert = "Comment posted successfully";
        header("location: /blog/image_post.php?image_id=$image_id&alert=$showAlert");
    }
}


?>