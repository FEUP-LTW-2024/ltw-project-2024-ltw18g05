<?php
  declare(strict_types = 1);
  require_once(dirname(__DIR__).'/database/connection.db.php');
  require_once(dirname(__DIR__).'/database/user.class.php');
  require_once(dirname(__DIR__).'/database/session.class.php');
  $session = new Session();

  $db = getDatabaseConnection();
  $user = User::getUserWithPassword($db, $_POST['email'], $_POST['password']);
  
  if ($user) {
    $session->setId($user->id);

    $session->addMessage('success', 'You have logged in!');
    header('Location: /../pages/index.php');
    exit;

  } 
  else {
    $session->addMessage('error', 'Wrong password! Try again!');
    header('Location: /../pages/login.php');
  }
?>
