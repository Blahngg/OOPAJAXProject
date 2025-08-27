<?php
  require "../../../db/audio.php";

  if(!$_SESSION['isAdmin']){
    header('location: ../error/401.php');
  }

  $audio = new Audio('tbl_music');
  $audio->getMusicData();
  $audioData = $audio->res;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/admin/index.css">
  <title>Document</title>
  <script type="text/javascript" src="../../js/jquery.min.js"></script>
</head>
<body>
  <div class="header">
    <h1>Admin Homepage</h1>

    <div class="top-controls">
      <a href="addAudio.php"><button class="ratings-btn">Add</button></a>
      <form action="../../../db/userRequest.php" method="POST">
        <input type="submit" value="LOGOUT" name="logoutUser" class="logout-btn">
      </form>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Artist</th>
        <th>Album</th>
        <th>Ratings</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="tableData">
      <?php while ($row = mysqli_fetch_assoc($audioData)): ?>
        <tr>
          <td><?php echo $row['title']; ?></td>
          <td><?php echo $row['artist']; ?></td>
          <td><?php echo $row['album']; ?></td>
          <td><?php echo $row['average_rating']; ?></td>
          <td>
            <a href="view.php?music_id=<?php echo $row['music_id']; ?>"><button class="action-btn">VIEW</button></a>
            <a href="updateAudio.php?music_id=<?php echo $row['music_id']; ?>"><button class="action-btn">UPDATE</button></a>
            <button class="action-btn deleteBtn" data-id="<?php echo $row['music_id']; ?>">DELETE</button>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
<script>
  $('#tableData').on('click', function(e){
    if($(e.target).attr('class') == 'deleteBtn'){
      id = $(e.target).data('id');
      $.ajax({
        url: "../../../db/audioRequest.php",
        method: "POST",
        data: {
          'deleteAudio': true,
          'music_id': $(e.target).data('id')
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