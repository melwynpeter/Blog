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
    $codeTitle = $_POST['codeTitle'];
    $codeContent = $_POST['codeContent'];

    $codeTitle = str_replace("<", "&lt;", $codeTitle);
    $codeTitle = str_replace(">", "&gt;", $codeTitle);

    $codeContent = str_replace("<", "&lt;", $codeContent);
    $codeContent = str_replace(">", "&gt;", $codeContent);

    $sql = "INSERT INTO `html_posts` (`html_title`, `html_content`, `user_id`, `timestamp`) VALUES ('$codeTitle', '$codeContent', '$user_id', current_timestamp())";
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