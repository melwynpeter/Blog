<?php
// includeing the database connection
include "_db_connect.php";

// $showError and $showAlert
$showError = false;
$showAlert = false;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $sql = "SELECT * FROM `users` WHERE `user_username` = '$username'";
    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);
    // checking if the user already exists(username is unique)
    if($num == 0){

        // checking if the user inputed password already exists
        if($password == $confirmPassword){
            $username = str_replace("<", "&lt;", $username);
            $username = str_replace(">", "&gt;", $username);

            $password = str_replace("<", "&lt;", $password);
            $password = str_replace(">", "&gt;", $password);
            $hash = password_hash($password, PASSWORD_DEFAULT); 
            $sql = "INSERT INTO `users` (`user_username`, `user_password`, `timestamp`) VALUES('$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $showAlert = "Signed Up sucessfully, Please Login to continue";
            header("location: /blog/login.php?alert=$showAlert");
        }
        else{
            $showError = "Sorry the password which you have entered does not match<br>";
            header("location: /blog/signup.php?err=$showError");
        }
    }
    else{
        $showError = "hey man how are you doing there is already an entry by this name<br>";
        header("location: /blog/signup.php?err=$showError");

    }
}

?>