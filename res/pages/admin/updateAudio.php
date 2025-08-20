<?php
  require "../../../db/audio.php";
  $audio = new Audio('tbl_audio');
  $audio->select('*', $_GET);
  $data = $audio->res;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="../../../db/audioRequest.php" method="POST", enctype="multipart/form-data">
    <?php while($row = mysqli_fetch_assoc($data)): ?>
      Cover: <?php echo $audio->selectCoverFIle($row['cover_file_id'], 'filename') ?> <input type="file" name="coverFile" accept=".jpeg, .png" id=""> <br>
      Title: <input type="text" name="title" id="" value="<?php echo $row['title'] ?>">  <br>
      Artist: <input type="text" name="artist" id="" value="<?php echo $row['artist'] ?>"> <br>
      Audio: <?php echo $audio->selectAudioFIle($row['audio_file_id'], 'filename') ?> <input type="file" name="audioFile" accept=".mp3, .wav" id=""> <br>
    <?php endwhile; ?>
    <input type="submit" value="Submit" name="addAudio">
  </form>
</body>
</html>