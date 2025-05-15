<?php
session_start();
// including the database connection
include "_db_connect.php";

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $username = $_SESSION['username'];

    $sql = "SELECT * FROM `users` WHERE `user_username` = '$username'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
}

$showError = false;
$showAlert = false;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $title = $_POST['title'];
    $content = $_POST['content'];

    $title = str_replace("<", "&lt;", $title);
    $title = str_replace(">", "&gt;", $title);

    $content = str_replace("<", "&lt;", $content);
    $content = str_replace(">", "&gt;", $content);

    $sql = "INSERT INTO `blog_posts` (`blog_title`, `blog_content`, `user_id`, `timestamp`) VALUES ('$title', '$content', '$user_id', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        $showError = "Blog not posted due to some issues";
        header("location: /blog/index.php?err=$showError");
    }
    else{
        $showAlert = "Blog posted successfully";
        header("location: /blog/index.php?alert=$showAlert");
    }
}
?>