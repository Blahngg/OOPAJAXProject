<?php
  require_once "like.php";
  $like = new Like('tbl_like');

  if(isset($_POST['addLike'])){
    unset($_POST['addLike']);
    if(!$like->checkUserLike($_POST['music_id'])){
      $like->insert(['user_id' => $_SESSION['user_id'], 'music_id' => $_POST['music_id']]);
      echo 'liked';
    }
    else{
      $like->removeLike($_POST['music_id']);
      echo 'unliked';
    }
  }

  if(isset($_POST['checkUserLike'])){
    unset($_POST['checkUserLike']);
    if($like->checkUserLike($_POST['music_id'])){
      echo 'true';
    }
    else{
      echo 'false';
    }
  }
?>