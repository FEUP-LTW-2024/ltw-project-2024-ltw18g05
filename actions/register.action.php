<?php
declare(strict_types = 1);
require_once(dirname(__DIR__).'/database/session.class.php');
require_once(__DIR__ . '/../database/connection.db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password1"]) && isset($_POST["password2"])) {
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        $username = $_POST["username"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];
        if ($password1 !== $password2) {
            $session->addMessage('warning', 'Passwords dont match');
            die(header('Location: ../pages/register.php'));
        }

        $session = new Session();
        $db = getDatabaseConnection();

        $stmt = $db->prepare("INSERT INTO User (Username, Password, Email) VALUES (:username, :password, :email)");
        
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password1);
        
        $stmt->execute();
        $stmt->closeCursor();

        $session->addMessage('success', "User registered");
        header("Location: /../pages/index.php");
        exit();
    } 
    else {
        $session->addMessage('warning', "All fields are required");
        die(header('Location: ../pages/register.php'));
    }
} else {
    header("Location: /../pages/register.php");
    exit();
}
?>
