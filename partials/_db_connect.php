<?php
// connecting to a database
$servername = "localhost";
$username = "root";
$password = "";
$database = "kind";

// creating a connection
$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    die("Connection not created successfully" . mysqli_connect_error());
}
?>