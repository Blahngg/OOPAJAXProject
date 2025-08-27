<?php
  require "../../../db/user.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/user/register.css">
  <title>Document</title>
</head>
<body>
  <div class="card">
    <h1>Register User</h1>
    <form action="../../../db/userRequest.php" method="POST">
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" required>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required>
      </div>
      <div class="form-group">
        <label>Re-enter Password</label>
        <input type="password" name="confirmPassword" required>
      </div>
      <div class="btn-container">
        <input type="submit" name="registerUser" value="Register">
        <a href="login.php"><button type="button">Cancel</button></a>
      </div>
      <div class="extra">
        Already have an account? Click <a href="login.php">here</a>
      </div>
    </form>
  </div>
</body>
</html>