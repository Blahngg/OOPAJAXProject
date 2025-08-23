<?php
  require_once "../../../db/user.php";

  if((isset($_SESSION['user_id'])) && (isset($_SESSION['isAdmin']))){
    header('location: index.php');
  }
  elseif(isset($_SESSION['user_id']) && !(isset($_SESSION['isAdmin']))){
    header('location: ../user');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Admin Login</h1>
  <form action="../../../db/userRequest.php" method="POST">
    <div id="inputCont">
      <div id="message">
        <?php
          if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
          }
        ?>
      </div>
      <div id="usernameCont">
        <input type="text" name="usernameEmail">
      </div>
      <div id="passwordCont">
        <input type="password" name="password">
      </div>
      <div id="btnCont">
        <input type="submit" name="loginAdmin" value="LOGIN">
        <button type="button">Cancle</button>
      </div>  
      <div id="extraCont">
        Don't have an account.Click <a href="register.php">here</a>
      </div>
    </div>
  </form>
</body>
</html>