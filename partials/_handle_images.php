<?php
session_start();
// including the database connection
include "_db_connect.php";

// check if the user is logged in or not
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
    $file = $_FILES['image'];
    print_r($file);
    $name = $file['name'];
    $full_path = $file['full_path'];
    $type = $file['type'];
    $tmp_name = $file['tmp_name'];
    $error = $file['error'];
    $size = $file['size'];

    $extension = explode(".", $name);
    print_r($extension);
    $real_extension = end($extension); // the real last extension
    echo "<br>This is the isolated extension: " . end($extension) . "<br>";

    // restricting the extensions : what file extensions are allowed to be uploaded 
    $extension_array = array("jpg", "png", "jpeg");
    echo in_array($real_extension, $extension_array, true) . "<br>";

    // changing the name
    $new_name = uniqid('', true) . ".$real_extension";

    // new location to save the uploaded file
    $new_location = "..\uploads\\" . $new_name;

    // checking if there is an error while uploading a file
    if($error == 0){
        // checking the extension of the uploaded file
        if(in_array($real_extension, $extension_array, true)){
            // checking the size of the uploaded file
            if($size < 1000000){
                // Uploading the file to the server
                if(move_uploaded_file($tmp_name, $new_location)){
                    echo "Successfully uploaded the file<br>";

                    $image_title = $_POST['imageTitle'];
                    $image_description = $_POST['imageDescription'];

                    $image_title = str_replace("<", "&lt;", $image_title);
                    $image_title = str_replace(">", "&gt;", $image_title);

                    $image_description = str_replace("<", "&lt;", $image_description);
                    $image_description = str_replace(">", "&gt;", $image_description);

                    // saving file name into the database
                    $sql = "INSERT INTO `image_posts` (`image_name`, `image_title`, `image_description`, `user_id`, `timestamp`) VALUES('$new_name', '$image_title', '$image_description', '$user_id', current_timestamp())";
                    $result = mysqli_query($conn, $sql);
                    $showAlert = "Image uploaded successfully";
                    header("location: /blog/index.php?alert=$showAlert");
                }
                else{
                    $showError = "File has not been uploaded";
                    header("location: /blog/index.php?err=$showError");
                }
            }
            else{
                $showError = "Your file is not less than 1mb";
                header("location: /blog/index.php?err=$showError");
            }
        }
        else{
            $showError = "Your file with the extension .$real_extension is not allowed";
            header("location: /blog/index.php?err=$showError");
        }
        }
    else{
        $showError = "some error occurred";
        header("location: /blog/index.php?err=$showError");
    }

}
?>