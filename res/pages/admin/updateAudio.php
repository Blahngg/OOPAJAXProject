<?php
  require "../../../db/audio.php";

  if(!$_SESSION['isAdmin']){
    header('location: ../error/401.php');
  }

  $audio = new Audio('tbl_music');
  $genre = new Audio('tbl_genres');

  $genre->select();
  $allGenres = $genre->res;
  $audio->getMusicData($_GET['music_id']);
  $data = $audio->res;
  $audio->getMusicGenres($_GET['music_id']);
  $genres = $audio->res;

  $music_genres = [];
  while($genreRow = mysqli_fetch_assoc($genres)) {
    $music_genres[] = $genreRow['genre_id'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/admin/updateAudio.css">
  <title>Document</title>
</head>
<body>
  <a href="javascript:history.back()" class="back-btn">← Back</a>

  <h1>Update Music</h1>

  <form action="../../../db/audioRequest.php" method="POST" enctype="multipart/form-data">
    <?php while($row = mysqli_fetch_assoc($data)): ?>
      <label class="current-file">Cover: <?php echo htmlspecialchars($row['coverFilename']); ?></label>
      <input type="file" name="coverFile" accept=".jpeg, .png, .jpg" />

      <label for="title">Title:</label>
      <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($row['title']); ?>" />

      <label for="artist">Artist:</label>
      <input type="text" name="artist" id="artist" value="<?php echo htmlspecialchars($row['artist']); ?>" />

      <label for="album">Album:</label>
      <input type="text" name="album" id="album" value="<?php echo htmlspecialchars($row['album']); ?>" />

      <label>Genres:</label>
      <div class="checkbox-group">
        <?php while($allGenreRow = mysqli_fetch_assoc($allGenres)): ?>
          <label>
            <input type="checkbox"
                   name="musicGenre[]"
                   value="<?php echo $allGenreRow['genre_id']; ?>"
                   <?php if(in_array($allGenreRow['genre_id'], $music_genres)) echo "checked"; ?>>
            <?php echo htmlspecialchars($allGenreRow['genre']); ?>
          </label>
        <?php endwhile; ?>
      </div>

      <label class="current-file">Audio: <?php echo htmlspecialchars($row['audioFilename']); ?></label>
      <input type="file" name="audioFile" accept=".mp3, .wav" />

      <input type="hidden" name="music_id" value="<?php echo $row['music_id']; ?>" />
    <?php endwhile; ?>

    <input type="submit" value="Submit" name="updateAudio" />
  </form>
</body>
</html>