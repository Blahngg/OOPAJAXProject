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
  <link rel="stylesheet" href="../../css/user/view.css">
  <script type="text/javascript" src="../../js/jquery.min.js"></script>
  <title>Document</title>
</head>
<body>
  <a href="javascript:history.back()" class="back-btn">← Back</a>
  <h1>Music Page</h1>

  <div class="container">
    <div id="col1">
      <?php while($row = mysqli_fetch_assoc($musicData)): ?>
        <img src="<?php echo htmlspecialchars($row['coverFIlepath']); ?>" alt="<?php echo htmlspecialchars($row['coverFilename']); ?>" />
        <h2><?php echo htmlspecialchars($row['title']); ?></h2>
        <p><strong>Artist:</strong> <?php echo htmlspecialchars($row['artist']); ?></p>
        <p><strong>Rating:</strong> <?php echo htmlspecialchars($row['average_rating']); ?></p>

        <audio id="audioElement" controls data-id="<?php echo htmlspecialchars($row['music_id']); ?>">
          <source src="<?php echo htmlspecialchars($row['audioFilepath']); ?>" type="audio/wav" />
          <source src="<?php echo htmlspecialchars($row['audioFilepath']); ?>" type="audio/mp3" />
          Your browser does not support the audio element.
        </audio>

        <button id="likeBtn" data-id="<?php echo $row['music_id'] ?>">Like</button>

        <form action="../../../db/ratingRequest.php" method="POST">
          <?php if(isset($_SESSION['message'])): ?>
            <span id="message"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></span>
          <?php endif; ?>
          <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
          <input type="hidden" name="music_id" value="<?php echo htmlspecialchars($row['music_id']); ?>">

          <label for="rating">Rating:</label>
          <select id="rating" name="rating" required>
            <option value="" disabled selected>Select rating</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>

          <label for="review">Review:</label>
          <textarea id="review" name="review" rows="6" placeholder="Write your review here..."></textarea>

          <input type="submit" value="Submit" name="addRating" />
        </form>
      <?php endwhile; ?>
    </div>

    <div id="col2">
      <h2>User Reviews</h2>
      <?php while($row = mysqli_fetch_assoc($ratingData)): ?>
        <div class="reviewDiv">
          <strong>Rating:</strong> <?php echo htmlspecialchars($row['rating']); ?>/5
          <strong>Review:</strong> <?php echo nl2br(htmlspecialchars($row['review'])); ?>
        </div>
      <?php endwhile; ?>
    </div>
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

  $(document).ready(function(){
    $.ajax({
      url: "../../../db/likeRequest.php",
      method: "POST",
      data: {
        'checkUserLike': true,
        'music_id': $('#likeBtn').data('id')
      },
      success:function(result){
        if(result.trim() === 'true'){
          $('#likeBtn').css('background-color', 'blue');
        }
      },
      error:function(error){
        //console.log(error);
        alert("Something went wrong!");
      }
    })
  })

  $('#likeBtn').on('click',function(){
    $.ajax({
      url: "../../../db/likeRequest.php",
      method: "POST",
      data: {
        'addLike': true,
        'music_id': $('#likeBtn').data('id')
      },
      success:function(result){
        if(result.trim() === 'liked'){
          $('#likeBtn').css('background-color', 'blue');
        }
        else if(result.trim() === 'unliked'){
          $('#likeBtn').css('background-color', '');
        }
      },
      error:function(error){
        //console.log(error);
        alert("Something went wrong!");
      }
    })
  })

  
</script>
</html>