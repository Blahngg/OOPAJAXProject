<?php
  require "../../../db/user.php";

  if(!$_SESSION['isAdmin']){
    header('location: ../error/401.php');
  }

  $db = new DB('tbl_genres');
  $db->select();
  $genres = $db->res;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/admin/addAudio.css">
  <title>Document</title>
</head>
<body>
  <a href="javascript:history.back()" class="back-btn">Back</a>

  <h1>Add Music</h1>

  <form action="../../../db/audioRequest.php" method="POST" enctype="multipart/form-data">
    <label for="coverFile">Cover:</label>
    <input type="file" name="coverFile" accept=".jpeg, .png, .jpg" id="coverFile" />

    <label for="title">Title:</label>
    <input type="text" name="title" id="title" />

    <label for="artist">Artist:</label>
    <input type="text" name="artist" id="artist" />

    <label for="album">Album:</label>
    <input type="text" name="album" id="album" />

    <div class="checkbox-group">
      <?php while($row = mysqli_fetch_assoc($genres)): ?>
        <label>
          <input type="checkbox" name="musicGenre[]" value="<?php echo $row['genre_id']; ?>" />
          <?php echo $row['genre']; ?>
        </label>
      <?php endwhile; ?>
    </div>

    <label for="audioFile">Audio:</label>
    <input type="file" name="audioFile" accept=".mp3, .wav" id="audioFile" />

    <input type="submit" value="Submit" name="addAudio" />
  </form>
</body>
</html>