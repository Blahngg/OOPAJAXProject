<?php
  require_once "db.php";

  class Audio extends DB{

    public function __construct($tbl_name){
      try{
        DB::__construct($tbl_name);
      }catch(Exception $e){
        die($e);
      }
    }

    function saveAudioFilepath(){
      try{
        $target_dir = "../res/uploads/audio_uploads/";
        $storage_dir = "../../uploads/audio_uploads/";
        $tmpName = $_FILES['audioFile']['tmp_name'];
        $fileName = basename($_FILES['audioFile']['name']);

        $uniqueFilename = uniqid() . "_" . $fileName;
        $upload_directory = $target_dir . $uniqueFilename;
        $database_directory = $storage_dir . $uniqueFilename;

        // upload the file to the directory
        move_uploaded_file($tmpName, $upload_directory);

        // store the name and the filepath to the database
        $stmt = $this->conn->prepare("INSERT INTO tbl_audio_filepath(`filename`, filepath) VALUES (?,?)");
        $stmt->bind_param('ss', $fileName, $database_directory);
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
        $storage_dir = "../../uploads/image_uploads/";
        $tmpName = $_FILES['coverFile']['tmp_name'];
        $fileName = basename($_FILES['coverFile']['name']);

        $uniqueFilename = uniqid() . "_" . $fileName;
        $upload_directory = $target_dir . $uniqueFilename;
        $database_directory = $storage_dir . $uniqueFilename;

        // upload the file to the directory
        move_uploaded_file($tmpName, $upload_directory);

        // store the name and the filepath to the database
        $stmt = $this->conn->prepare("INSERT INTO tbl_cover_filepath(`filename`, filepath) VALUES (?,?)");
        $stmt->bind_param('ss', $fileName, $database_directory);
        $stmt->execute();
        $cover_id = $stmt->insert_id;
        $stmt->close();
        unset($_POST['coverFIle']);
        return $cover_id;
      }catch(Exception $e){
        die('Error: ' . $e);
      }
    }

    public function addStream($music_id) {
      try{
        $currentDatetime = date("Y-m-d H:i:s");
        $stmt = $this->conn->prepare("INSERT INTO tbl_streams(user_id, music_id, date) VALUES (?,?,?)");
        $stmt->bind_param('iis', $_SESSION['user_id'], $music_id, $currentDatetime);
        $stmt->execute();
        $stmt->close();
      }catch(Exception $e){
        die('Error while inserting data: <br>'. $e);
      }
    }

    public function getMusicData($music_id = NULL){
      try{
        if(!is_null($music_id)){
          $stmt = $this->conn->prepare(
            "SELECT tbl_music.music_id, title, artist, album, tbl_cover_filepath.filename AS coverFilename,  tbl_cover_filepath.filepath AS coverFIlepath, tbl_audio_filepath.filename AS audioFilename, tbl_audio_filepath.filepath AS audioFilepath, AVG(tbl_rating.rating) as average_rating
            FROM tbl_music
            INNER JOIN tbl_audio_filepath ON tbl_music.audio_filepath_id = tbl_audio_filepath.audio_filepath_id
            INNER JOIN tbl_cover_filepath ON tbl_music.cover_filepath_id = tbl_cover_filepath.cover_filepath_id
            LEFT JOIN tbl_rating ON tbl_music.music_id = tbl_rating.music_id
            WHERE tbl_music.music_id = ?"
          );
          $stmt->bind_param('i', $music_id);
        }
        else{
          $stmt = $this->conn->prepare(
            "SELECT tbl_music.music_id, title, artist, album, tbl_cover_filepath.filename AS coverFilename,  tbl_cover_filepath.filepath AS coverFIlepath, tbl_audio_filepath.filename AS audioFilename, tbl_audio_filepath.filepath AS audioFilepath, AVG(tbl_rating.rating) as average_rating
            FROM tbl_music
            INNER JOIN tbl_audio_filepath ON tbl_music.audio_filepath_id = tbl_audio_filepath.audio_filepath_id
            INNER JOIN tbl_cover_filepath ON tbl_music.cover_filepath_id = tbl_cover_filepath.cover_filepath_id
            LEFT JOIN tbl_rating ON tbl_music.music_id = tbl_rating.music_id
            GROUP BY tbl_music.music_id"
          );
        }
    
        $stmt->execute();
        $this->res = $stmt->get_result();
      }catch(Exception $e){
        die("Error requesting data!. <br>". $e);
      }
    }

    public function getRecommendedMusicData(){
      try{
        $stmt = $this->conn->prepare(
            "SELECT tbl_music.music_id, title, artist, album, tbl_music_genre.genre_id, tbl_cover_filepath.filename AS coverFilename,  tbl_cover_filepath.filepath AS coverFIlepath, tbl_audio_filepath.filename AS audioFilename, tbl_audio_filepath.filepath AS audioFilepath
            FROM tbl_music
            INNER JOIN tbl_music_genre ON tbl_music.music_id=tbl_music_genre.music_id
            INNER JOIN tbl_audio_filepath ON tbl_music.audio_filepath_id = tbl_audio_filepath.audio_filepath_id
            INNER JOIN tbl_cover_filepath ON tbl_music.cover_filepath_id = tbl_cover_filepath.cover_filepath_id
            WHERE tbl_music_genre.genre_id IN (SELECT DISTINCT tbl_music_genre.genre_id
                FROM tbl_like
                INNER JOIN tbl_users ON tbl_users.user_id=tbl_like.user_id
                INNER JOIN tbl_music_genre on tbl_music_genre.music_id=tbl_like.music_id
                WHERE tbl_like.user_id=?)");
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $this->res = $stmt->get_result();
      }catch(Exception $e){
        die("Error requesting data!. <br>". $e);
      }
    }

    public function getTopStreamsMusicData(){
      try{
        $stmt = $this->conn->prepare(
            "SELECT tbl_music.music_id, title, artist, album, COUNT(tbl_streams.music_id) AS streams, tbl_cover_filepath.filename AS coverFilename,  tbl_cover_filepath.filepath AS coverFIlepath, tbl_audio_filepath.filename AS audioFilename, tbl_audio_filepath.filepath AS audioFilepath
            FROM tbl_music
            LEFT JOIN tbl_streams ON tbl_music.music_id=tbl_streams.music_id
            INNER JOIN tbl_audio_filepath ON tbl_music.audio_filepath_id = tbl_audio_filepath.audio_filepath_id
            INNER JOIN tbl_cover_filepath ON tbl_music.cover_filepath_id = tbl_cover_filepath.cover_filepath_id
            GROUP BY tbl_music.music_id
            ORDER BY COUNT(tbl_streams.music_id) DESC");
        $stmt->execute();
        $this->res = $stmt->get_result();
      }catch(Exception $e){
        die("Error requesting data!. <br>". $e);
      }
    }

    public function getTopRatingMusicData(){
      try{
        $stmt = $this->conn->prepare(
            "SELECT tbl_music.music_id, title, artist, album, AVG(tbl_rating.rating) as average_rating, tbl_cover_filepath.filename AS coverFilename,  tbl_cover_filepath.filepath AS coverFIlepath, tbl_audio_filepath.filename AS audioFilename, tbl_audio_filepath.filepath AS audioFilepath
            FROM tbl_music
            LEFT JOIN tbl_rating ON tbl_music.music_id=tbl_rating.music_id
            INNER JOIN tbl_audio_filepath ON tbl_music.audio_filepath_id = tbl_audio_filepath.audio_filepath_id
            INNER JOIN tbl_cover_filepath ON tbl_music.cover_filepath_id = tbl_cover_filepath.cover_filepath_id
            GROUP BY tbl_music.music_id
            ORDER BY AVG(tbl_rating.rating) DESC");
        $stmt->execute();
        $this->res = $stmt->get_result();
      }catch(Exception $e){
        die("Error requesting data!. <br>". $e);
      }
    }

    public function getMusicGenres($music_id){
      try{
        $stmt = $this->conn->prepare(
          "SELECT tbl_genres.genre_id, tbl_genres.genre
          FROM tbl_music
          INNER JOIN tbl_music_genre ON tbl_music.music_id  = tbl_music_genre.music_id
          INNER JOIN tbl_genres ON tbl_music_genre.genre_id = tbl_genres.genre_id
          WHERE tbl_music.music_id = ?"
        );
        $stmt->bind_param('i', $music_id);
        $stmt->execute();
        $this->res = $stmt->get_result();
      }catch(Exception $e){
        die("Error requesting data!. <br>". $e);
      }
    }
  }

?>