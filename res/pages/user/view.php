<?php
  require "../../../db/audio.php";
  $audio = new Audio('tbl_music');
  $rating = new Audio('tbl_rating');

  $audio->getMusicData($_GET['music_id']);
  $rating->select('*', $_GET);

  $musicData = $audio->res;
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
      Cover: <img src="<?php echo $row['coverFIlepath'] ?>" alt="<?php echo $row['coverFilename'] ?>"> <br>
      Title: <?php echo $row['title'] ?>  <br>
      Artist: <?php echo $row['artist'] ?> <br>
      Rating: <?php echo $row['average_rating'] ?> <br>
      <audio id="audioElement" controls data-id="<?php echo $row['music_id']; ?>">
        <source src="<?php echo $row['audioFilepath']; ?>" type="audio/wav">
        <source src="<?php echo $row['audioFilepath']; ?>" type="audio/mp3">
      </audio> <br>
      <form action="../../../db/ratingRequest.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        <input type="hidden" name="music_id" value="<?php echo $row['music_id']; ?>">
        Rating: <br>
        <select name="rating" id="">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select> <br>
        Review: <br>
        <textarea name="review" rows="10" cols="40"></textarea> <br>
        <input type="submit" value="Submit" name="addRating">
      </form>
    <?php endwhile; ?>
  </div>
  <div id="col2">
    <?php while($row = mysqli_fetch_assoc($ratingData)): ?>
      <div id="reviewDiv">
        <?php echo $row['rating']; ?> <br>
        <?php echo $row['review']; ?>
      </div>
    <?php endwhile; ?>
  </div>
</body>
<script>
  $('#audioElement').one('ended', function(e){
    $.ajax({
      url: "../../../db/audioRequest.php",
      method: "POST",
      data: {
        'addStream': true,
        'music_id': $(e.target).data('id')
      },
      success:function(result){
        alert("Music Ended");
      },
      error:function(error){
        //console.log(error);
        alert("Something went wrong!");
      }
    })
  });
</script>
</html>