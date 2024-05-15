<?php
declare(strict_types = 1);
require_once(dirname(__DIR__).'/database/session.class.php');
require_once(__DIR__ . '/../database/connection.db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["itemId"]) && isset($_POST["userId"])) {

        $itemId = $_POST["itemId"];
        $userId = $_POST["userId"];

        $session = new Session();
        $db = getDatabaseConnection();

        $stmt = $db->prepare("INSERT INTO Wishlist (User_Id, Item_Id) VALUES (:userId, :itemId)");
        
        $stmt->bindValue(':userId', $userId);
        $stmt->bindValue(':itemId', $itemId);
        
        $stmt->execute();
        $stmt->closeCursor();

        $session->addMessage('success', "Item Added to Wishlist");
        header("Location: ../");
        exit();
    } 
    else {
        $session->addMessage('warning', "All fields are required");
        die(header('Location: ../'));
    }
} else {
    //header("Location: /../pages/login.php");
    exit();
}
?>
