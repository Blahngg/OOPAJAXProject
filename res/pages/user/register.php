<?php
  require "../../../db/user.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Register User</h1>
  <form action="../../../db/userRequest.php" method="POST">
    <div id="inputCont">
      <div id="usernameCont">
        Username: <input type="text" name="username" required>
      </div>
      <div id="emailCont">
        Email: <input type="text" name="email" required>
      </div>
      <div id="passwordCont">
        Password: <input type="password" name="password" required>
      </div>
      <div id="confirmPasswordCont">
        Re-enter Password: <input type="password" name="confirmPassword" required>
      </div>
      <div id="btnCont">
        <input type="submit" name="registerUser" value="Register">
        <a href="login.php"><button type="button">Cancle</button></a>
      </div>  
      <div id="extraCont">
        Already have an account.Click <a href="login.php">here</a>
      </div>
    </div>
  </form>
</body>
</html>