<?php
//including the database connection
include "_db_connect.php";

// $showError and $showAlert
$showError = false;
$showAlert = false;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE `user_username` = '$username'";
    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);
    if($num == 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['user_password'])){
            echo "login succesful";
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['user_username'];
            $showAlert = "Logged in Succesfully";
            header("location: /blog/index.php?alert=$showAlert");
        }
        else{
            $showError = "password incorrect";
            header("location: /blog/login.php?err=$showError");
        }
    }
    else{
        $showError = "username incorrect";
        header("location: /blog/login.php?err=$showError");
    }
}
?>