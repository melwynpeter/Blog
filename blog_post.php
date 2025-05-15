<?php
  include "partials/_nav.php";
  // including the database connection
  include "partials/_db_connect.php";
  $loggedin = false;
  $user_id = false;
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $loggedin = true;
    $username = $_SESSION['username'];

    $sql = "SELECT * FROM `users` WHERE `user_username` = '$username'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <style>
      .blog{
        display: flex;
        flex-direction: row;
      }
      .likesanddislikes-card{
        align-self: start;
      }
    </style>
    <style media="all and (max-width: 500px)">
      .blog{
        display: flex;
        flex-direction: column;
      }
      .likesanddislikes-card{
        align-self: center;
      }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <div class="blog container">
      <?php
      if(isset($_GET['blog_id'])){
        $blog_id = $_GET['blog_id'];
      }
      $sql = "SELECT * FROM `blog_posts` WHERE `blog_id` = '$blog_id'";
      $result = mysqli_query($conn, $sql);

      $row = mysqli_fetch_assoc($result);
      $title = $row['blog_title'];
      $content = $row['blog_content'];
      echo '<div class="container me-0 ms-2 pe-0">
              <div class="blog-post">
                  <h2 class="title">' . $title . '</h2>
                  <p class="post">' . $content . '</p>
              </div>
            </div>';
      ?>

      <!-- Likes And Dislikes Section -->
      <?php
        $sql = "SELECT * FROM `likesanddislikes` WHERE `user_id` = '$user_id' AND `blog_id` = '$blog_id'";
        $result = mysqli_query($conn, $sql);

        $num = mysqli_num_rows($result);
        $likesanddislikes_content = false;
        if($num > 0){
          $row = mysqli_fetch_assoc($result);
          $likesanddislikes_content = $row['likesanddislikes_content'];
        }

        if($likesanddislikes_content == 1){
          $likeColor = "white";
        }
        else{
          $likeColor = "black";
        }

        if($likesanddislikes_content == -1){
          $dislikeColor = "white";
        }
        else{
          $dislikeColor = "black";
        }
      ?>
      <div class="likesanddislikes-card container ms-2 me-0" style="width: 18rem;">
            <div class="card" style="width: 18rem;"> 
              <div class="card-body">
                <!-- <form action="partials/_handle_likesanddislikes.php" method="post"> -->
                <div class="card-body-head d-flex flex-row align-items-center">
                  <?php
                  // like button
                  echo '<button type="submit" id="like" class="btn btn-success card-link mx-2" name="like" style="color:' . $likeColor . ';">like</button>';

                  $sql = "SELECT * FROM `likesanddislikes` WHERE `likesanddislikes_content` = 1 AND `blog_id` = $blog_id";
                  $result = mysqli_query($conn, $sql);

                  $likeCount = mysqli_num_rows($result);
                  
                  echo '<p id="likeCount" class="mx-1 my-auto align-self-center">' . $likeCount . '</p>';
                  ?>
                  <!-- hidden input for like number -->
                  <input type="hidden" id="likeNumber">
                  
                
                  <?php
                  // dislike button
                  echo '<button type="submit" id="dislike" class="btn btn-success card-link mx-2" name="dislike" style="color: ' . $dislikeColor . ';">dislike</button>';
                  $sql = "SELECT * FROM `likesanddislikes` WHERE `likesanddislikes_content` = -1 AND `blog_id` = '$blog_id'";
                  $result = mysqli_query($conn, $sql);

                  $dislikeCount = mysqli_num_rows($result);

                  echo '<p id="dislikeCount" class="mx-1 my-auto align-self-centers">' . $dislikeCount . '</p>';
                  
                  ?>
                  <!-- hidden input for dislike number -->
                  <input type="hidden" id="dislikeNumber">

                  
                  <!-- hidden input for blog_id -->
                  <?php
                  echo '<input type="hidden" id="blog_id" value="' . $blog_id . '">';
                  ?>

                </div>
                <hr>
                <!-- </form> -->
                <!-- <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a> -->
                <?php
                $sql = "SELECT * FROM `blog_posts` WHERE `blog_id` = '$blog_id'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                $user_id = $row['user_id'];

                $sql = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                $username = $row['user_username'];
                echo '<p class="card-text"></p>
                <h5 class="card-title">' . $username . '</h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>'; // p : blog post description, h6 : card subtitle
                ?>
              </div>
            </div>
      </div>
    </div>

    <!-- Comment Section -->
    <div class="container">
        <div class="card" style="width: 70%;">
          <div class="card-body">
            <?php
            $sql = "SELECT * FROM `comments` WHERE `";
            echo '<form action="partials/_handle_comments.php?blog_id=' . $blog_id . '" method="post">
                  <div class="mb-3">
                    <label for="comment" class="form-label">Post a comment</label>
                    <input type="text" class="form-control" id="comment" aria-describedby="blog_comment" name="comment">
                  </div>
                  
                  <button type="submit" class="btn btn-success">Post</button>
            </form>';
            ?>
            <hr>
            <div class="comments">

            <?php
            $noResult = true;
            if(isset($_GET['blog_id'])){
              $blog_id = $_GET['blog_id'];
            }

            $sql = "SELECT * FROM `comments` WHERE `blog_id` = '$blog_id'";
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)){
              $noResult = false;
              $comment_content = $row['comment_content'];
              $comment_by = $row['user_id'];

              $sql_comment_by = "SELECT * FROM `users` WHERE `user_id` = '$comment_by'";
              $result_comment_by = mysqli_query($conn, $sql_comment_by);

              $row_comment_by = mysqli_fetch_assoc($result_comment_by);

              // checking if the user is logged in or not: to display the username/ comment_by
              if($comment_by > 0){
                $comment_by_username = $row_comment_by['user_username'];
              }
              else{
                $comment_by_username = "Anonymous User";
              }
              echo '<div class="comment">
                      <h4>' . $comment_by_username . '</h4>
                      <p>' . $comment_content . '</p>
                    </div>';
            }
            
            if($noResult == true){
              echo '<div class="container text-center">
                      <h3>No Comments yet</h3>
                      <p>Be the first one to Comment on this post</p>
                    </div>
                    ';
            }
            ?>
              </div>
            </div>
          </div>
        </div>
    </div>
    <script src="js/app.js"><script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>
