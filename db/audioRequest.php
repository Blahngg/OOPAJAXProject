<?php
  require "audio.php";
  $db = new Audio("tbl_audio");

  // ayusin yung attributes ng child classes
  // ayusing yung error handling nung parehas na file upload

  if(isset($_POST['addAudio'])){
    unset($_POST['addAudio']);
    $audio_id = $db->saveAudioFilepath();
    $cover_id = $db->saveCoverFilepath();
    $_POST['audio_file_id'] = $audio_id;
    $_POST['cover_file_id'] = $cover_id;
    $db->insert($_POST);
    header('location: ../res/pages/admin/index.php');
  }
  
  if(isset($_POST['updateAudio'])){
    unset($_POST['addAudio']);
    $_POST['audio_file_id'] = $db->saveAudioFilepath();
    $_POST['cover_file_id'] = $db->saveCoverFilepath();
    $db->update($_POST);
  }

  if(isset($_POST['deleteAudio'])){
    unset($_POST['deleteAudio']);
    $db->delete($_POST);
  }
?>