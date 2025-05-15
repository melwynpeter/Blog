<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speal</title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <?php include "partials/_nav.php"; ?>
    <?php include "partials/_db_connect.php"; ?>
    <!-- <h2 class="text-center my-2">Write a Post</h2> -->
    
    <?php
    $sql = "SELECT * FROM `html_posts`";
    $result = mysqli_query($conn, $sql);


    while($row = mysqli_fetch_assoc($result)){
      $html_title = $row['html_title'];
      $html_content = $row['html_content'];
      $html_id = $row['html_id'];
      $user_id = $row['user_id'];

      $sql_author = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
      $result_author = mysqli_query($conn, $sql_author);

      $row_author = mysqli_fetch_assoc($result_author);
      $author_name = $row_author['user_username'];

      echo '<div class="container">
      <div class="blog">
          <div class="post_header d-flex justify-content-between" width="700">
          <h2 class="title" style="padding: 0 30px 0 0; width: 600px;">' . $html_title . '</h2>
          <ul class="text-start">
          <h5 class="card-title">' . $author_name . '</h5>
          <h6 class="card-subtitle mb-2 text-muted"></h6>
          </ul>
          </div>
          <p class="descripton">' . substr($html_content, 0, 455) . '...</p>
          <a id="btn" class="btn btn-success" href="blog_post.php?blog_id=' . $html_id . '">Read More</a>
      </div>
  </div>';
    }
    ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>
