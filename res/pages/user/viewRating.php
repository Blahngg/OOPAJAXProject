<?php
  require "../../../db/rating.php";
  $rating = new Rating('tbl_rating');
  $rating->getRatingData($_GET['rating_id']);
  $ratingData = $rating->res;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Update Rating</h1>
  <form action="../../../db/ratingRequest.php" method="POST">
    <?php while($row = mysqli_fetch_assoc($ratingData)): ?>
      Title: <?php echo $row['title'] ?>  <br>
      Artist: <?php echo $row['artist'] ?> <br>
      Rating: <br>
        <select name="rating" id="">
          <?php for($x=1; $x < 6; $x++): ?>
            <option value="<?php echo $x; ?>" <?php if($x == $row['rating']) echo "selected"; ?>><?php echo $x ?></option>
          <?php endfor; ?>
        </select> <br>
      Review: <br>
      <textarea name="review" rows="10" cols="40"><?php echo $row['review']; ?></textarea> <br>
      <input type="hidden" name="rating_id" value="<?php echo $row['rating_id']; ?>">
      <input type="submit" value="Submit" name="updateRating">
    <?php endwhile; ?>
  </form>
</body>
</html>