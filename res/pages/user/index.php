<?php
  // check nalang yung readme kung anong methods yung kailangan para maidisplay yung data na iba
  // test mo na rin lahat
  // edit mo nalang yung mga select query kung may mga data ka na gustong makuha o palabasin

  require "../../../db/audio.php";
  $audio = new Audio('tbl_music');
  $audio->getTopRatingMusicData();
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
  <h1>User Homepage</h1>
  <form action="../../../db/userRequest.php" method="POST">
    <input type="submit" value="LOGOUT" name="logoutUser">
  </form>
  <a href="ratings.php"><button>Ratings</button></a>
  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Artist</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($audioData)): ?>
        <tr>
          <td><?php echo $row['title']; ?></td>
          <td><?php echo $row['artist']; ?></td>
          <td><a href="view.php?music_id=<?php echo $row['music_id'] ?>"><button>VIEW</button></a></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>