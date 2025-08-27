<?php
  require_once "db.php";

  class Rating extends DB{

    public function __construct($tbl_name){
      try{
        DB::__construct($tbl_name);
      }catch(Exception $e){
        die($e);
      }
    }

    public function getUserRatings(){
      try{
        $stmt = $this->conn->prepare(
          "SELECT tbl_rating.rating_id, tbl_music.music_id, title, artist, album, rating, review
          FROM tbl_rating
          INNER JOIN tbl_music ON tbl_music.music_id=tbl_rating.music_id
          WHERE tbl_rating.user_id = ?"
        );
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $this->res = $stmt->get_result();
      }catch(Exception $e){
        die("Error requesting data!. <br>". $e);
      }
    }

    public function getRatingData($rating_id){
      try{
        $stmt = $this->conn->prepare(
          "SELECT tbl_rating.rating_id, tbl_music.music_id, title, artist, album, rating, review, tbl_rating.user_id
          FROM tbl_rating
          INNER JOIN tbl_music ON tbl_music.music_id=tbl_rating.music_id
          WHERE tbl_rating.user_id = ? AND tbl_rating.rating_id = ?"
        );
        $stmt->bind_param('ii', $_SESSION['user_id'], $rating_id);
        $stmt->execute();
        $this->res = $stmt->get_result();
      }catch(Exception $e){
        die("Error requesting data!. <br>". $e);
      }
    
    }
    public function checkUserRating($music_id){
      try{
        $stmt = $this->conn->prepare(
          "SELECT *
          FROM tbl_rating
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
  }
?>