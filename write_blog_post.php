<?php
include "partials/_nav.php";
$loggedin = false;
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  $loggedin = true;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a Blog</title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <div class="container my-3">
        <h2>Write a Post</h2>
        <div class="blog">
          <?php
          if($loggedin == true){
          echo '<form action="partials/_handle_blog_posts.php" method="post">
                <div class="mb-3">
                  <label for="title" class="form-label">Blog Title</label>
                  <input type="title" class="form-control" id="title" name="title" aria-describedby="blog_title">
                </div>
                <div class="mb-3">
                  <label for="content" class="form-label">Blog Content</label>
                  <textarea class="form-control" placeholder="Write a Blog" id="content" name="content" style="height: 300px"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post</button>
              </form>';
          }
          else{
            echo "please login to continue<br>";
          }
          ?>
            </div>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>
