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
  <title>Document</title>
</head>
<body>
  <h1>Update Music</h1>
  <form action="../../../db/audioRequest.php" method="POST", enctype="multipart/form-data">
    <?php while($row = mysqli_fetch_assoc($data)): ?>
      Cover: <?php echo $row['coverFilename'] ?> <input type="file" name="coverFile" accept=".jpeg, .png" id=""> <br>
      Title: <input type="text" name="title" id="" value="<?php echo $row['title'] ?>">  <br>
      Artist: <input type="text" name="artist" id="" value="<?php echo $row['artist'] ?>"> <br>
      Album: <input type="text" name="album" id="" value="<?php echo $row['album'] ?>"> <br>
      Genres: 
        <?php while($allGenreRow = mysqli_fetch_assoc($allGenres)): ?>
          <input type="checkbox" 
            name="musicGenre[]" 
            value="<?php echo $allGenreRow['genre_id']; ?>" 
            <?php if(in_array($allGenreRow['genre_id'], $music_genres)) echo "checked"; ?>>
            <?php echo $allGenreRow['genre']; ?>
        <?php endwhile; ?>
      <br> Audio: <?php echo $row['audioFilename'] ?> <input type="file" name="audioFile" accept=".mp3, .wav" id=""> <br>
      <input type="hidden" name="music_id" value="<?php echo $row['music_id']; ?>">
    <?php endwhile; ?>
    <input type="submit" value="Submit" name="updateAudio">
  </form>
</body>
</html>