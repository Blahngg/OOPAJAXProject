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
  <script type="text/javascript" src="../../js/jquery.min.js"></script>
  <title>Document</title>
</head>
<body>
  <h1>Music Page</h1>
  <div id="col1">
    <?php while($row = mysqli_fetch_assoc($musicData)): ?>
      Cover: <img src="<?php echo $row['coverFIlepath']; ?>" alt="<?php echo $row['coverFilename']; ?>"> <br>
      Title: <?php echo $row['title'] ?>  <br>
      Artist: <?php echo $row['artist'] ?> <br>
      Album: <?php echo $row['album'] ?> <br>
      Genre:
        <?php while($genreRow = mysqli_fetch_assoc($genreData)): ?>
          <?php echo $genreRow['genre']; ?>
        <?php endwhile; ?> <br>
      <audio controls>
        <source src="<?php echo $row['audioFilepath']; ?>" type="audio/wav">
        <source src="<?php echo $row['audioFilepath']; ?>" type="audio/mp3">
      </audio>
    <?php endwhile; ?>
  </div>
  <div id="col2">
    <?php while($row = mysqli_fetch_assoc($ratingData)): ?>
      <div id="reviewDiv">
        <?php echo $row['rating']; ?> <br>
        <?php echo $row['review']; ?> <br>
        <button class="deleteBtn" data-id="<?php echo $row['rating_id'] ?>">DELETE</button>
      </div>
    <?php endwhile; ?>
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