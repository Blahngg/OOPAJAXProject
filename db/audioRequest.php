<?php
  require_once "audio.php";
  require_once "genre.php";
  $db = new Audio("tbl_music");
  $genre = new Genre('tbl_music_genre');

  // ayusin yung attributes ng child classes
  // ayusing yung error handling nung parehas na file upload

  if(isset($_POST['addAudio'])){
    unset($_POST['addAudio']);

    $_POST['audio_filepath_id'] = $db->saveAudioFilepath();
    $_POST['cover_filepath_id'] = $db->saveCoverFilepath();

    $genreData = $_POST['musicGenre'];
    unset($_POST['musicGenre']);

    $music_id = $db->insert($_POST);
    $genre->storeGenres($music_id, $genreData);

    header('location: ../res/pages/admin/index.php');
  }
  
  if(isset($_POST['updateAudio'])){
    unset($_POST['updateAudio']);

    if(isset($_POST['coverFile'])){
      $_POST['cover_filepath_id'] = $db->saveCoverFilepath();
    }
    else{
      unset($_POST['coverFile']);
    }
    
    if(isset($_POST['audioFile'])){
      $_POST['audio_filepath_id'] = $db->saveAudioFilepath();
    }
    else{
      unset($_POST['audioFile']);
    }

    $genreData = $_POST['musicGenre'];
    unset($_POST['musicGenre']);

    $genre->deleteGenres($_POST['music_id']);
    $genre->storeGenres($_POST['music_id'], $genreData);
    $db->update($_POST, 'music_id');
    header('location: ../res/pages/admin/index.php');
  }

  if(isset($_POST['deleteAudio'])){
    unset($_POST['deleteAudio']);
    $db->delete($_POST);
  }

  if(isset($_POST['addStream'])){
    if(isset($_SESSION['user_id'])){
      unset($_POST['addStream']);
      $db->addStream($_POST['music_id']);
    }
  }
?>