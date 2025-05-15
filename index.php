<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speal</title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
      .image_post{
        width: 700px;
      }
      .imagePost{
        display: flex;
        flex-direction: row;
      }
      .likesanddislikes-card{
        align-self: start;
      }
      .image{
        background: #212529;
        width: 700px;
        max-height: 400px;
        overflow: hidden;
      }
      .image img{
        width: auto;
        height: auto;
      }
    </style>
    <style media="all and (max-width: 1000px)">
      .image_post{
        width: 300px;
      }
      .imagePost{
        display: flex;
        flex-direction: column;
      }
      .likesanddislikes-card{
        align-self: center;
      }
      .image{
        background: #212529;
        width: 300px;
        max-height: 200px;
        overflow: hidden;
      }
      .image img{
        width: 100%;
        height: auto;
      }
    </style>
  </head>
  
  <body>
    <?php include "partials/_nav.php"; ?>
    <?php include "partials/_db_connect.php"; ?>
    <!-- <h2 class="text-center my-2">Write a Post</h2> -->
    
    <?php
    $sql = "SELECT * FROM `image_posts` ORDER BY `image_posts`.`image_id` DESC";
    $result = mysqli_query($conn, $sql);


    while($row = mysqli_fetch_assoc($result)){
      $image_id = $row['image_id'];
      $image_name = $row['image_name'];
      $image_title = $row['image_title'];
      $image_description = $row['image_description'];
      $user_id = $row['user_id'];

      $sql_author = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
      $result_author = mysqli_query($conn, $sql_author);

      $row_author = mysqli_fetch_assoc($result_author);
      $author_name = $row_author['user_username'];

      echo '<div class="container mx-0">
              <div class="image_post">
              <div class="image">
              <img src="uploads/' . $image_name . '" class="card-img-top mx-auto d-block"  alt="' . $image_name . '">
              </div>
                  <div class="post_header d-flex justify-content-between" width="700">
                          <h2 class="card-title" style="padding: 0 30px 0 0; width: 600px;">' . $image_title . '</h2>
                          <ul class="text-start">
                          <h5 class="card-title">' . $author_name . '</h5>
                          <h6 class="card-subtitle mb-2 text-muted"></h6>
                          </div>
                          <div class="card-body">
                          </ul>
                          <p class="card-text">' . substr($image_description, 0, 455) . '...</p>
                          <a id="btn" class="btn btn-success" href="image_post.php?image_id=' . $image_id . '">See Post</a>
                      </div>
                  </div>
            </div>';
    }
    ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>
