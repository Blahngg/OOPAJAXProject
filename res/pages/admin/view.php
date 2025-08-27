<?php
  require "../../../db/audio.php";

  if(!$_SESSION['isAdmin']){
    header('location: ../error/401.php');
  }

  $audio = new Audio('tbl_music');
  $rating = new Audio('tbl_rating');
  $genre= new Audio('tbl_genres');

  $audio->getMusicData($_GET['music_id']);
  $genre->getMusicGenres($_GET['music_id']);
  $rating->select('*', $_GET);

  $musicData = $audio->res;
  $genreData = $genre->res;
  $ratingData = $rating->res;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/admin/view.css">
  <script type="text/javascript" src="../../js/jquery.min.js"></script>
  <title>Document</title>
</head>
<body>
  <h1>Music Page</h1>

  <a href="javascript:history.back()" class="back-btn">← Back</a>

  <div class="container">
    <div id="col1">
      <?php while($row = mysqli_fetch_assoc($musicData)): ?>
        <img src="<?php echo htmlspecialchars($row['coverFIlepath']); ?>" alt="<?php echo htmlspecialchars($row['coverFilename']); ?>" />
        <div>Title: <?php echo htmlspecialchars($row['title']); ?></div>
        <div>Artist: <?php echo htmlspecialchars($row['artist']); ?></div>
        <div>Album: <?php echo htmlspecialchars($row['album']); ?></div>

        <div id="genres">
          Genre: 
          <?php 
            $genreNames = [];
            mysqli_data_seek($genreData, 0); // reset pointer for reuse
            while($genreRow = mysqli_fetch_assoc($genreData)){
              $genreNames[] = htmlspecialchars($genreRow['genre']);
            }
            echo implode(', ', $genreNames);
          ?>
        </div>

        <audio controls>
          <source src="<?php echo htmlspecialchars($row['audioFilepath']); ?>" type="audio/wav" />
          <source src="<?php echo htmlspecialchars($row['audioFilepath']); ?>" type="audio/mp3" />
          Your browser does not support the audio element.
        </audio>
      <?php endwhile; ?>
    </div>

    <div id="col2">
      <?php while($row = mysqli_fetch_assoc($ratingData)): ?>
        <div id="reviewDiv">
          <strong>Rating:</strong> <?php echo htmlspecialchars($row['rating']); ?>
          <strong>Review:</strong> <?php echo nl2br(htmlspecialchars($row['review'])); ?>
          <button class="deleteBtn" data-id="<?php echo htmlspecialchars($row['rating_id']); ?>">DELETE</button>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</body>
<script>
  $('#col2').on('click', function(e){
    if($(e.target).attr('class') == 'deleteBtn'){
      id = $(e.target).data('id');
      $.ajax({
        url: "../../../db/ratingRequest.php",
        method: "POST",
        data: {
          'deleteRating': true,
          'rating_id': $(e.target).data('id')
        },
        success:function(result){
          alert("DATA DELETED");
          location.reload();
        },
        error:function(error){
          //console.log(error);
          alert("Something went wrong!");
        }
      })
    }
  });
</script>
</html>