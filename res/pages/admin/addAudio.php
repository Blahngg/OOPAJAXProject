<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="../../../db/audioRequest.php" method="POST", enctype="multipart/form-data">
    Cover: <input type="file" name="coverFile" accept=".jpeg, .png" id=""> <br>
    Title: <input type="text" name="title" id="">  <br>
    Artist: <input type="text" name="artist" id=""> <br>
    Audio: <input type="file" name="audioFile" accept=".mp3, .wav" id=""> <br>
    <input type="submit" value="Submit" name="addAudio">
  </form>
</body>
</html>