<?php
  require "../../../db/rating.php";

  if(!isset($_SESSION['user_id'])){
    header('location: login.php');
  }

  $rating = new Rating('tbl_rating');
  $rating->getRatingData($_GET['rating_id']);
  $ratingData = $rating->res;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/user/viewRating.css">
  <title>Document</title>
</head>
<body>
  <h1>Update Rating</h1>

  <div class="form-container">
    <form action="../../../db/ratingRequest.php" method="POST">
      <?php while($row = mysqli_fetch_assoc($ratingData)): ?>

        <div class="form-group">
          <label>Title</label>
          <p class="input-box"><?php echo $row['title']; ?></p>
        </div>

        <div class="form-group">
          <label>Artist</label>
          <p class="input-box"><?php echo $row['artist']; ?></p>
        </div>

        <div class="form-group">
          <label for="rating">Rating</label>
          <select name="rating" id="rating">
            <?php for($x = 1; $x < 6; $x++): ?>
              <option value="<?php echo $x; ?>" <?php if($x == $row['rating']) echo "selected"; ?>>
                <?php echo $x; ?>
              </option>
            <?php endfor; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="review">Review</label>
          <textarea name="review" id="review"><?php echo $row['review']; ?></textarea>
        </div>

        <input type="hidden" name="rating_id" value="<?php echo $row['rating_id']; ?>">

        <div class="form-actions">
          <!-- Back -->
          <a href="ratings.php" class="btn btn-back">Back</a>

          <!-- Update & Delete -->
          <div class="right-buttons">
            <button type="submit" class="btn btn-submit" name="updateRating">Update</button>
            <button type="submit" class="btn btn-delete" name="deleteRating"
              onclick="return confirm('Are you sure you want to delete this rating?')">
              Delete
            </button>
          </div>
        </div>

      <?php endwhile; ?>
    </form>
  </div>
</body>
</html>