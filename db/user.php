<?php
  require_once "db.php";
  class User extends DB{

    public function __construct($tbl_name){
      try{
        DB::__construct($tbl_name);
      }catch(Exception $e){
        die($e);
      }
    }



    public function loginUser($where, $password){
      try{
        $stmt = $this->conn->prepare("SELECT * FROM $this->tbl_name WHERE username=? OR email=?");
        $stmt->bind_param('ss', $where, $where);
        $stmt->execute();
        $data = $stmt->get_result();
        while($row = mysqli_fetch_assoc($data)){
          if(password_verify($password, $row['password'])){
            $_SESSION['user_id']= $row['user_id'];

            if($row['isAdmin']){
              $_SESSION['isAdmin'] = true;
            }
            else{
              $_SESSION['isAdmin'] = false;
            }

            unset($_SESSION['message']);
          }
        }
      }catch(Exception $e){
        die("Error requesting data!. <br>". $e);
      }
    }

    public function logoutUser(){
      try{
        unset($_SESSION['user_id']);
        if($_SESSION['isAdmin']){
          unset($_SESSION['isAdmin']);
          header('location: ../res/pages/admin/login.php');
        }
        else{
          header('location: ../res/pages/user/login.php');
        }
      }catch(Exception $e){
        die("Error requesting data!. <br>". $e);
      }
    }
  }
?>