<?php
  class DB{
    private $sesrvername = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "music";
    public $tbl_name;
    public $res;
    public $conn;

    public function __construct($tbl_name){
      try{
        $this->conn = new mysqli($this->sesrvername, $this->username, $this->password, $this->db_name, 3308);
        $this->tbl_name = $tbl_name;
      }catch(Exception $e){
        die('Database connection error:. <br>'. $e);
      }
    }

    public function __destruct(){
      $this->conn->close();
    }

    public function select($row = "*", $where = NULL){
      try{
        if(!is_null($where)){
          $cond=$types="";
          foreach($where as $key => $value){
            $cond .= $key . " = ? AND ";
            $types .= substr(gettype($value), 0, 1);
          }
          $cond = substr($cond, 0, -4);
          $stmt = $this->conn->prepare("SELECT $row FROM $this->tbl_name WHERE $cond");
          $stmt->bind_param($types, ...array_values($where));
        }else{
          $stmt = $this->conn->prepare("SELECT $row FROM $this->tbl_name");
        }
        $stmt->execute();
        $this->res = $stmt->get_result();
      }catch(Exception $e){
        die("Error requesting data!. <br>". $e);
      }
    }

    public function insert($data){
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

    public function update($data){
      try{
        $prep=$types="";
        foreach($data as $key => $value){
          if($key == 'id'){
            $where = "$key=?";
          }
          else{
            $prep .="$key=?,";
          }
          $types .= substr(gettype($value),0,1);
        }
        $prep = substr($prep, 0, -1);
        $stmt = $this->conn->prepare("UPDATE $this->tbl_name SET $prep WHERE $where");
        $stmt->bind_param($types, ...array_values($data));
        $stmt->execute();
        $stmt->close();
      }catch(Exception $e){
        die('Error while updating data: <br>'. $e);
      }
    }

    public function delete($data){
      try{
        $prep=$types="";
        foreach($data as $key => $value){
          $prep .="$key=?,";
          $types .= substr(gettype($value),0,1);
        }
        $prep = substr($prep, 0, -1);
        $stmt = $this->conn->prepare("DELETE FROM $this->tbl_name WHERE $prep");
        $stmt->bind_param($types, ...array_values($data));
        $stmt->execute();
        $stmt->close();
      }catch(Exception $e){
        die('Error while deleting data: <br>'. $e);
      }
    }

    /*public function search($table, $row = "*", $where = NULL){
      try{
        $data = "%" . $where .  "%";

        $stmt = $this->conn->prepare("SELECT $row FROM $table WHERE full_name LIKE ? OR email LIKE ? OR course_year_section LIKE ?");
        $stmt->bind_param('sss', $data, $data, $data);

        $stmt->execute();
        $this->res = $stmt->get_result();
      }catch(Exception $e){
        die("Error requesting data!. <br>". $e);
      }
    }*/
  }
?>
    