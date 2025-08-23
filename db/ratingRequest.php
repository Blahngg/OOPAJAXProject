<?php
  require_once "db.php";
  $db = new DB('tbl_rating');

  if(isset($_POST['addRating'])){
    unset($_POST['addRating']);
    $db->insert($_POST);
    header("location: ../res/pages/user/view.php?music_id=" .$_POST['music_id']);
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