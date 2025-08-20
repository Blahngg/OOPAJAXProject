<?php
  require "db.php";

  class Audio extends DB{

    public function __construct($tbl_name){
      try{
        DB::__construct($tbl_name);
      }catch(Exception $e){
        die($e);
      }
    }

    function selectAudioFIle($data, $output){
      try{
        $stmt = $this->conn->prepare("SELECT * FROM tbl_audio_filepath WHERE id=? LIMIT 1");
        $stmt->bind_param( 'i', $data);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if($output == 'filepath'){
          $data = "../../" . substr($row['filepath'], 7);
        }
        elseif($output == 'filename'){
          $data = $row['filename'];
        }
        return $data;
      }catch(Exception $e){
        die("Error requesting data!. <br>". $e);
      }
    }

    function selectCoverFIle($data, $output){
      try{
        $stmt = $this->conn->prepare("SELECT * FROM tbl_cover_filepath WHERE id=? LIMIT 1");
        $stmt->bind_param( 'i', $data);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if($output == 'filepath'){
          $data = "../../" . substr($row['filepath'], 7);
        }
        elseif($output == 'filename'){
          $data = $row['filename'];
        }
        return $data;
      }catch(Exception $e){
        die("Error requesting data!. <br>". $e);
      }
    }

    function saveAudioFilepath(){
      try{
        $target_dir = "../res/uploads/audio_uploads/";
        $tmpName = $_FILES['audioFile']['tmp_name'];
        $fileName = basename($_FILES['audioFile']['name']);
        $upload_directory = $target_dir . uniqid() . "_" . $fileName;

        // upload the file to the directory
        move_uploaded_file($tmpName, $upload_directory);

        // store the name and the filepath to the database
        $stmt = $this->conn->prepare("INSERT INTO tbl_audio_filepath(`filename`, filepath) VALUES (?,?)");
        $stmt->bind_param('ss', $fileName, $upload_directory);
        $stmt->execute();
        $audio_id = $stmt->insert_id;
        $stmt->close();
        unset($_POST['audioFIle']);
        return $audio_id;
      }catch(Exception $e){
        die('Error: ' . $e);
      }
    }

    function saveCoverFilepath(){
      try{
        $target_dir = "../res/uploads/image_uploads/";
        $tmpName = $_FILES['coverFile']['tmp_name'];
        $fileName = basename($_FILES['coverFile']['name']);
        $upload_directory = $target_dir . uniqid() . "_" . $fileName;

        // upload the file to the directory
        move_uploaded_file($tmpName, $upload_directory);

        // store the name and the filepath to the database
        $stmt = $this->conn->prepare("INSERT INTO tbl_cover_filepath(`filename`, filepath) VALUES (?,?)");
        $stmt->bind_param('ss', $fileName, $upload_directory);
        $stmt->execute();
        $cover_id = $stmt->insert_id;
        $stmt->close();
        unset($_POST['coverFIle']);
        return $cover_id;
      }catch(Exception $e){
        die('Error: ' . $e);
      }
    }
  }

?>