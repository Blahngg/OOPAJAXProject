<?php
  require "../../../db/like.php";

  $like = new Like('tbl_like');

  $like->getUserLikes();
  $likes = $like->res;
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div id="likesCont">
      <h4>Liked Songs</h4>
      <div class="cardscont">
        <?php while ($row = mysqli_fetch_assoc($likes)): ?>
            <div class="cardcont">
              <a href="view.php?music_id=<?php echo $row['music_id'] ?>">
                <div class="card">
                  <div class="imgCont">
                    <img src="<?php echo $row['coverFIlepath']; ?>" alt="" height="100" width="100">
                  </div>
                  <div class="detailsCont">
                    Title: <?php echo $row['title']; ?> <br>
                    Artist: <?php echo $row['artist']; ?> <br>
                  </div>
                </div>
              </a>
            </div>
        <?php endwhile; ?>
      </div>
    </div>
</body>
</html>