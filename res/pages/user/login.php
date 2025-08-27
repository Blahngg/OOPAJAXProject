<?php
  require "../../../db/user.php";

  if(isset($_SESSION['user_id'])){
    header('location: ../user');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/user/login.css">
  <title>Document</title>
</head>
<body>
  <form action="../../../db/userRequest.php" method="POST">
    <h1>User Login</h1>
    <div id="inputCont">
      <div id="message">
        <?php
          if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
          }
          ?>
      </div>
      <div id="usernameCont">
        <input type="text" name="usernameEmail" placeholder="Username or email">
      </div>
      <div id="passwordCont">
        <input type="password" name="password" placeholder="Password">
      </div>
      <div id="btnCont">
        <input type="submit" name="loginUser" value="LOGIN">
        <button type="button">Cancel</button>
      </div>  
      <div id="extraCont">
        Don't have an account? Click <a href="register.php">here</a>
      </div>
    </div>
  </form>
</body>
</html>