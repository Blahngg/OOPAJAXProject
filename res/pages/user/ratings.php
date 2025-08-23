<?php
  require "../../../db/rating.php";
  $audio = new Rating('tbl_rating');
  $audio->getUserRatings();
  $audioData = $audio->res;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript" src="../../js/jquery.min.js"></script>
  <title>Document</title>
</head>
<body>
  <h1>User Ratings</h1>
  <form action="../../../db/userRequest.php" method="POST">
    <input type="submit" value="LOGOUT" name="logoutUser">
  </form>
  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Artist</th>
        <th>Rating</th>
        <th>Review</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="tblBody">
      <?php while ($row = mysqli_fetch_assoc($audioData)): ?>
        <tr>
          <td><?php echo $row['title']; ?></td>
          <td><?php echo $row['artist']; ?></td>
          <td><?php echo $row['rating']; ?></td>
          <td><?php echo $row['review']; ?></td>
          <td>
            <a href="viewRating.php?rating_id=<?php echo $row['rating_id'] ?>"><button>UPDATE</button></a>
            <button class="deleteBtn" data-id="<?php echo $row['rating_id'] ?>">Delete</button>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
<script>
  $('#tblBody').on('click', function(e){
    if($(e.target).attr('class') == 'deleteBtn'){
      id = $(e.target).data('id');
      $.ajax({
        url: "../../../db/ratingRequest.php",
        method: "POST",
        data: {
          'deleteRating': true,
          'rating_id': $(e.target).data('id')
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