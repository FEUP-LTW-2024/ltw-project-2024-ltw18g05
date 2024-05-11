<?php
    declare(strict_types = 1);
    require_once(dirname(__DIR__).'/database/connection.db.php');
    require_once(dirname(__DIR__).'/database/session.class.php');
    $session = new Session();

    $_SESSION['input']['username newUser'] = htmlentities($_POST['username']);
    $_SESSION['input']['email newUser'] = htmlentities($_POST['email']);
    $_SESSION['input']['password1 newUser'] = htmlentities($_POST['password1']);
    $_SESSION['input']['password2 newUser'] = htmlentities($_POST['password2']);
    $_SESSION['input']['profile_picture newUser'] = htmlentities($_POST['profile_picture']);

    $db = getDatabaseConnection();
    if ($_POST['password1'] === $_POST['password2']) {

        $cost = ['cost' => 12];
        $stmt = $db->prepare('INSERT INTO User (name, email, password, address, phoneNumber) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($_POST['username'], $_POST['email'], password_hash($_POST['password1'], PASSWORD_DEFAULT, $cost), $_POST['profile_picture']));

    } 
    else {
        die(header('Location: ../register/user.register.php'));
    }

    unset($_SESSION['input']);

    header('Location: ../pages/login.php');
?>