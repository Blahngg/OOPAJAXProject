<?php
  require "../../../db/rating.php";

  if(!isset($_SESSION['user_id'])){
    header('location: login.php');
  }

  $audio = new Rating('tbl_rating');
  $audio->getUserRatings();
  $audioData = $audio->res;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/user/ratings.css">
  <script type="text/javascript" src="../../js/jquery.min.js"></script>
  <title>Document</title>
</head>
<body>
  <div class="header">
    <h1>User Ratings</h1>
    <div class="header-buttons">
      <a href="index.php" class="btn-back">BACK</a>
      <form action="../../../db/userRequest.php" method="POST">
        <input type="submit" value="LOGOUT" name="logoutUser">
      </form>
    </div>
  </div>

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
            <div class="action-buttons">
              <a href="viewRating.php?rating_id=<?php echo $row['rating_id'] ?>"><button>UPDATE</button></a>
              <button class="deleteBtn" data-id="<?php echo $row['rating_id'] ?>">Delete</button>
            </div>
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