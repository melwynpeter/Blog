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
    // image_id
    $image_id = 0;
    if(isset($_POST['imageId'])){
        $image_id = $_POST['imageId'];
        echo $image_id;
    }

    // likeNumber
    $likesanddislikes = false;
    if(isset($_POST['likeNumber'])){
        $likesanddislikes = $_POST['likeNumber'];
    }
    $sql = "SELECT * FROM `likesanddislikes_images` WHERE `image_id` = '$image_id' AND `user_id` = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if($num == 0){
        $sql = "INSERT INTO `likesanddislikes_images` (`likesanddislikes_content`, `image_id`, `user_id`, `timestamp`) VALUES('$likesanddislikes', '$image_id', '$user_id', current_timestamp())";
        $result = mysqli_query($conn, $sql);
    }
    else{
        $sql = "UPDATE `likesanddislikes_images` SET `likesanddislikes_content` = '$likesanddislikes', `image_id` = '$image_id', `user_id` = '$user_id', `timestamp` = current_timestamp() WHERE `image_id` = '$image_id' AND `user_id` = '$user_id'";
        $result = mysqli_query($conn, $sql);
    }
    
    
}


// Number of likes and dislikes
$sql = "SELECT * FROM `likesanddislikes_images` WHERE `likesanddislikes_content` = 1";
$result = mysqli_query($conn, $sql);

$likeNum = mysqli_num_rows($result);

$sql = "SELECT * FROM `likesanddislikes_images` WHERE `likesanddislikes_content` = -1";
$result = mysqli_query($conn, $sql);

echo "hello world again";
?>