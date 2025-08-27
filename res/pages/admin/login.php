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
  <link rel="stylesheet" href="../../css/admin/login.css">
  <title>Document</title>
</head>
<body>
  <div class="login-wrapper">
    
    <form action="../../../db/userRequest.php" method="POST">
      <div id="inputCont">
        <h1>Admin Login</h1>
        <div id="message">
          <?php
            if(isset($_SESSION['message'])){
              echo $_SESSION['message'];
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
          <input type="submit" name="loginAdmin" value="LOGIN">
          <button type="button">Cancel</button>
        </div>
        <div id="extraCont">
          Don't have an account.Click <a href="register.php">here</a>
        </div>
      </div>
    </form>
  </div>
</body>
</html>