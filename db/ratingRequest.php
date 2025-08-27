<?php
  require_once "rating.php";
  $db = new Rating('tbl_rating');

  if(isset($_POST['addRating'])){
    if(isset($_SESSION['user_id'])){
      if(!$db->checkUserRating($_POST['music_id'])){
        unset($_POST['addRating']);
        $db->insert($_POST);
        header("location: ../res/pages/user/view.php?music_id=" .$_POST['music_id']);
      }
      else{
        $_SESSION['message'] = "You already submitted a review for this song";
        header("location: ../res/pages/user/view.php?music_id=" .$_POST['music_id']);
      }
    }
    else{
      $_SESSION['message'] = "You need to be logged-in to submit a review";
      header("location: ../res/pages/user/login.php");
    }
  }
  if(isset($_POST['deleteRating'])){
    unset($_POST['deleteRating']);
    $db->delete($_POST);
  }

  if(isset($_POST['updateRating'])){
    unset($_POST['updateRating']);
    $db->update($_POST, 'rating_id');
    header("location: ../res/pages/user/ratings.php");
  }
?>