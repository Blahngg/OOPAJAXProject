<?php
  require_once "db.php";
  class Genre extends DB{

    public function __construct($tbl_name){
      try{
        DB::__construct($tbl_name);
      }catch(Exception $e){
        die($e);
      }
    }

    public function storeGenres($music_id, $data){
      try{
        $genreData = [];
        $prep=$types="";
        foreach($data as $key => $value){
          $prep .='(?,?),';
          $types .= 'i' . substr(gettype($value),0,1);
          array_push($genreData, $music_id, $value);
        }
        $prep = substr($prep, 0, -1);
        $stmt = $this->conn->prepare("INSERT INTO $this->tbl_name(music_id, genre_id) VALUES $prep");
        $stmt->bind_param($types, ...$genreData);
        $stmt->execute();
        $stmt->close();
      }catch(Exception $e){
        die('Error while inserting data: <br>'. $e);
      }
    }

    public function deleteGenres($data){
      try{
        $stmt = $this->conn->prepare("DELETE FROM $this->tbl_name WHERE music_id=?");
        $stmt->bind_param('i', $data);
        $stmt->execute();
        $stmt->close();
      }catch(Exception $e){
        die('Error while deleting data: <br>'. $e);
      }
    }
  }
?>