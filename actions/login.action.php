<?php
  declare(strict_types = 1);
  require_once(dirname(__DIR__).'/database/connection.db.php');
  require_once(dirname(__DIR__).'/database/user.class.php');
  require_once(dirname(__DIR__).'/database/session.class.php');
  $session = new Session();

  $_SESSION['input']['email login'] = htmlentities($_POST['email']);
  $_SESSION['input']['password login'] = htmlentities($_POST['password']);

  $db = getDatabaseConnection();
  $user = User::getUserWithPassword($db, $_POST['email'], $_POST['password']);
  
  if ($user) {

    $_SESSION['id'] = $user->id;
    $_SESSION['username'] = $user->username;

    unset($_SESSION['input']['email login']);
    unset($_SESSION['input']['password login']);
    header('Location: ../pages/index.php');

  } 
  else {
    die(header('Location: ../pages/login.php'));
  }
?>
