<?php
  require "db.php";
  class User extends DB{

    public function __construct(){
      try{
        DB::__construct("users");
      }catch(Exception $e){
        die($e);
      }
    }

    public function registerUser($data){
      try{
        $table_columns = implode(',', array_keys($data));
        $prep=$types="";
        foreach($data as $key => $value){
          $prep .='?,';
          $types .= substr(gettype($value),0,1);
        }
        $prep = substr($prep, 0, -1);
        $stmt = $this->conn->prepare("INSERT INTO $this->tbl_name($table_columns) VALUES ($prep)");
        $stmt->bind_param($types, ...array_values($data));
        $stmt->execute();
        $stmt->close();
      }catch(Exception $e){
        die('Error while inserting data: <br>'. $e);
      }
    }

    public function loginUser($data){
      try{
        $table_columns = implode(',', array_keys($data));
        $prep=$types="";
        foreach($data as $key => $value){
          $prep .='?,';
          $types .= substr(gettype($value),0,1);
        }
        $prep = substr($prep, 0, -1);
        $stmt = $this->conn->prepare("INSERT INTO $this->tbl_name($table_columns) VALUES ($prep)");
        $stmt->bind_param($types, ...array_values($data));
        $stmt->execute();
        $stmt->close();
      }catch(Exception $e){
        die('Error while inserting data: <br>'. $e);
      }
    }
  }
?>