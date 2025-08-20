<?php
  require "../../../db/audio.php";
  $audio = new Audio('tbl_audio');
  $audio->select();
  $audioData = $audio->res;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Artist</th>
        <th>Player</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($audioData)): ?>
        <tr>
          <td><?php echo $row['title']; ?></td>
          <td><?php echo $row['artist']; ?></td>
          <td>
            <audio controls>
              <source src="<?php echo $audio->selectAudioFIle($row['audio_file_id'], 'filepath'); ?>" type="audio/wav">
              <source src="<?php echo $audio->selectAudioFIle($row['audio_file_id'], 'filepath'); ?>" type="audio/mp3">
            </audio>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>