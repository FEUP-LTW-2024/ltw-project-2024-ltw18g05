<?php
declare(strict_types = 1);
require_once(dirname(__DIR__).'/database/session.class.php');
require_once(__DIR__ . '/../database/connection.db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["category"])) {
        $category = $_POST["category"];

        $session = new Session();
        $db = getDatabaseConnection();

        $stmt = $db->prepare("INSERT INTO Category (Name) VALUES (:category)");
        
        $stmt->bindValue(':category', $category);
        
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
