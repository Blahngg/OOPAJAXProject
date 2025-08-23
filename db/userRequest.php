<?php
  require_once "user.php";
  $db = new User('tbl_users');

  if(isset($_POST['registerUser'])){
    unset($_POST['registerUser']);
    if($_POST['password'] == $_POST['confirmPassword']){
      unset($_POST['confirmPassword']);
      $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $db->insert($_POST);
      header('location: ../res/pages/user/login.php');
    }
    else{
      header('location: ../res/pages/user/register.php');
    }
  }

  if(isset($_POST['loginUser'])){
    unset($_POST['loginUser']);
    $db->loginUser($_POST['usernameEmail'], $_POST['password']);
    if(isset($_SESSION['user_id'])){
      header('location: ../res/pages/user/');
    }
    else{
      $_SESSION['message'] = "Invalid username or password";
      header('location: ../res/pages/user/login.php');
    }
  }

  if(isset($_POST['loginAdmin'])){
    unset($_POST['loginAdmin']);
    $db->loginUser($_POST['usernameEmail'], $_POST['password']);
    if(isset($_SESSION['user_id']) && isset($_SESSION['isAdmin'])){
      header('location: ../res/pages/admin/');
    }
    if(isset($_SESSION['user_id']) && !isset($_SESSION['isAdmin'])){
      header('location: ../res/pages/user/');
    }
    else{
      $_SESSION['message'] = "Invalid username or password";
      header('location: ../res/pages/admin/login.php');
    }
  }

  if(isset($_POST['logoutUser'])){
    unset($_POST['logoutUser']);
    unset($_SESSION['message']);
    $db->logoutUser();
  }
?>