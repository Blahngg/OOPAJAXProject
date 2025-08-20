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
  <script type="text/javascript" src="../../js/jquery.min.js"></script>
</head>
<body>
  <a href="addAudio.php">ADD</a>
  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Artist</th>
        <th>Player</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="tableData">
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
          <td>
            <a href="updateAudio.php?id=<?php echo $row['id']; ?>"><button>UPDATE</button></a>
            <button class="deleteBtn" data-id="<?php echo $row['id']; ?>">DELETE</button>
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
          'id': $(e.target).data('id')
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