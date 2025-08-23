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
  <title>Document</title>
</head>
<body>
  <h1>Add Music</h1>
  <form action="../../../db/audioRequest.php" method="POST", enctype="multipart/form-data">
    Cover: <input type="file" name="coverFile" accept=".jpeg, .png, .jpg" id=""> <br>
    Title: <input type="text" name="title" id="">  <br>
    Artist: <input type="text" name="artist" id=""> <br>
    Album: <input type="text" name="album" id=""> <br>
    <?php while($row = mysqli_fetch_assoc($genres)): ?>
      <input type="checkbox" name="musicGenre[]" value="<?php echo $row['genre_id']; ?>" id=""> <?php echo $row['genre']; ?>,
    <?php endwhile; ?> <br>
    Audio: <input type="file" name="audioFile" accept=".mp3, .wav" id=""> <br>
    <input type="submit" value="Submit" name="addAudio">
  </form>
</body>
</html>