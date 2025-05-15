<?php
session_start();

// including the database connection
include "_db_connect.php";

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo "hey you are logged in";
    // username
    $username = $_SESSION['username'];

    // fetching the id
    $sql = "SELECT * FROM `users` WHERE `user_username` = '$username'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
}






if($_SERVER['REQUEST_METHOD'] == "POST"){
    // blog_id
    $blog_id = 0;
    if(isset($_POST['blogId'])){
        $blog_id = $_POST['blogId'];
        echo $blog_id;
    }

    // likeNumber
    $likesanddislikes = false;
    if(isset($_POST['likeNumber'])){
        $likesanddislikes = $_POST['likeNumber'];
    }
    $sql = "SELECT * FROM `likesanddislikes` WHERE `blog_id` = '$blog_id' AND `user_id` = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if($num == 0){
        $sql = "INSERT INTO `likesanddislikes` (`likesanddislikes_content`, `blog_id`, `user_id`, `timestamp`) VALUES('$likesanddislikes', '$blog_id', '$user_id', current_timestamp())";
        $result = mysqli_query($conn, $sql);
    }
    else{
        $sql = "UPDATE `likesanddislikes` SET `likesanddislikes_content` = '$likesanddislikes', `blog_id` = '$blog_id', `user_id` = '$user_id', `timestamp` = current_timestamp() WHERE `blog_id` = '$blog_id' AND `user_id` = '$user_id'";
        $result = mysqli_query($conn, $sql);
    }
    
    
}


// Number of likes and dislikes
$sql = "SELECT * FROM `likesanddislikes` WHERE `likesanddislikes_content` = 1";
$result = mysqli_query($conn, $sql);

$likeNum = mysqli_num_rows($result);

$sql = "SELECT * FROM `likesanddislikes` WHERE `likesanddislikes_content` = -1";
$result = mysqli_query($conn, $sql);

echo "hello world again";
?>