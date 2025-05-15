<?php
session_start();

$username = false;
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  $username = $_SESSION['username'];
}

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Speal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/blog/index.php">Home</a>
        </li>
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="/blog/login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/blog/signup.php">Signup</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/blog/upload_images.php">Upload a Post</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/blog/write_blog_post.php">Write a Blog Post</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/blog/write_html_post.php">Post Code</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/blog/logout.php">Logout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <p class="text-center mx-2 my-2"> ' . $username . ' </p>
    </div>
  </div>
</nav>';

if(isset($_GET['err'])){
    $err = $_GET['err'];
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error</strong> ' . $err . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if(isset($_GET['alert'])){
    $alert = $_GET['alert'];
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> ' . $alert . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
echo '</body>
</html>';
?>