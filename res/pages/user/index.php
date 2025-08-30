<?php
  require "../../../db/audio.php";
  $audio = new Audio('tbl_music');
  $audio->getTopStreamsMusicData();
  $topStreams = $audio->res;

  if(!isset($_SESSION['user_id'])){
    $audio->getTopRatingMusicData();
    $topRated = $audio->res;
  }
  else{
    $audio->getRecommendedMusicData();
    $topRated = $audio->res;
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/user/index.css">
  <title>Document</title>
  <style>
    .cardscont {
      display: flex;
    }

    .cardcont{
      margin-right: 30px;
    }
  </style>
</head>
<body>
  <div class="header">
    <h1>User Homepage</h1>
    <div class="top-controls">
      <?php if(isset($_SESSION['user_id'])): ?>
        <a href="ratings.php"><button>Ratings</button></a>
        <a href="likes.php"><button>LIkes</button></a>
        <form action="../../../db/userRequest.php" method="POST">
          <input type="submit" value="LOGOUT" name="logoutUser">
        </form>
      <?php else: ?>
        <a href="login.php"><button>Login</button></a>
      <?php endif; ?>
    </div>
  </div>
  <div id="body">
    <div id="topRatingCont">
      <h4>Top Rated</h4>
      <div class="cardscont">
        <?php while ($row = mysqli_fetch_assoc($topStreams)): ?>
            <div class="cardcont">
              <a href="view.php?music_id=<?php echo $row['music_id'] ?>">
                <div class="card">
                  <div class="imgCont">
                    <img src="<?php echo $row['coverFIlepath']; ?>" alt="" height="100" width="100">
                  </div>
                  <div class="detailsCont">
                    Title: <?php echo $row['title']; ?> <br>
                    Artist: <?php echo $row['artist']; ?> <br>
                    Rating: <?php echo $row['streams']; ?>
                  </div>
                </div>
              </a>
            </div>
        <?php endwhile; ?>
      </div>
    </div>
    <div id="topStreamCont">
      <?php if(!isset($_SESSION['user_id'])): ?>
        <h4>Top Streams</h4>
      <?php else: ?>
        <h4>Recommendation</h4>
      <?php endif; ?>
      <div class="cardscont">
        <?php while ($row = mysqli_fetch_assoc($topRated)): ?>
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
  </div>
</body>
</html>