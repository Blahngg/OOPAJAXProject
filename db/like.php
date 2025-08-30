<?php
  require_once "db.php";

  class Like extends DB{
    public function __construct($tbl_name){
      try{
        DB::__construct($tbl_name);
      }catch(Exception $e){
        die($e);
      }
    }

    public function checkUserLike($music_id){
      try{
        $stmt = $this->conn->prepare(
          "SELECT *
          FROM tbl_like
          WHERE user_id=? AND music_id=?"
        );
        $stmt->bind_param('ii', $_SESSION['user_id'], $music_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result && $result->num_rows > 0){
          return true;
        }
        else{
          return false;
        }
      }catch(Exception $e){
        die("Error requesting data!. <br>". $e);
      }
    }

    public function removeLike($music_id){
      try{
        $stmt = $this->conn->prepare("DELETE FROM tbl_like WHERE user_id=? AND music_id=?");
        $stmt->bind_param('ii', $_SESSION['user_id'], $music_id);
        $stmt->execute();
        $stmt->close();
      }catch(Exception $e){
        die('Error while deleting data: <br>'. $e);
      }
    }

    public function getUserLikes(){
      try{
        $stmt = $this->conn->prepare(
            "SELECT tbl_music.music_id, title, artist, album, tbl_cover_filepath.filename AS coverFilename,  tbl_cover_filepath.filepath AS coverFIlepath, tbl_audio_filepath.filename AS audioFilename, tbl_audio_filepath.filepath AS audioFilepath
            FROM tbl_music
            INNER JOIN tbl_audio_filepath ON tbl_music.audio_filepath_id = tbl_audio_filepath.audio_filepath_id
            INNER JOIN tbl_cover_filepath ON tbl_music.cover_filepath_id = tbl_cover_filepath.cover_filepath_id
            INNER JOIN tbl_like ON tbl_music.music_id=tbl_like.music_id
            WHERE tbl_like.user_id=?");
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $this->res = $stmt->get_result();
      }catch(Exception $e){
        die("Error requesting data!. <br>". $e);
      }
    }
  }
?>