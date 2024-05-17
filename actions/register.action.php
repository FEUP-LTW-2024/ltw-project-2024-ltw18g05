<?php
declare(strict_types = 1);
require_once(dirname(__DIR__).'/database/session.class.php');
require_once(__DIR__ . '/../database/connection.db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["name"]) && isset($_POST["password1"]) && isset($_POST["password2"]) && isset($_POST["profilepicture"]) && isset($_POST["address"]) && isset($_POST["phone"])) {
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        $username = $_POST["username"];
        $name = $_POST["name"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];
        $profilepicture = $_POST["profilepicture"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        if ($password1 !== $password2) {
            $session->addMessage('warning', 'Passwords dont match');
            die(header('Location: ../pages/register.php'));
        }

        $session = new Session();
        $db = getDatabaseConnection();

        $stmt = $db->prepare("INSERT INTO User (Username, Name, Password, Email, Profile_Picture, Address, Phone) VALUES (:username, :name, :password, :email, :profilepicture, :address, :phone)");
        
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':password', $password1);
        $stmt->bindValue(':profilepicture', $profilepicture);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':phone', $phone);

        
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
