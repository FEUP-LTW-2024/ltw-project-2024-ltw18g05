<?php
declare(strict_types = 1);
require_once(dirname(__DIR__).'/database/session.class.php');
require_once(__DIR__ . '/../database/connection.db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["user1Id"]) && isset($_POST["user2Id"]) && isset($_POST["conversationId"]) && isset($_POST["itemId"]) && isset($_POST["message"])) {
        $user1Id = $_POST["user1Id"];
        $user2Id = $_POST["user2Id"];
        $conversationId = $_POST["conversationId"];
        $itemId = $_POST["itemId"];
        $message = $_POST["message"];

        $session = new Session();
        $db = getDatabaseConnection();

        $stmt = $db->prepare("INSERT INTO Message (Sender_Id, Receiver_Id, Conversation_Id, Message_text) VALUES (:user1Id, :user2Id, :conversationId, :message)");
        $stmt->bindValue(':user1Id', $user1Id);
        $stmt->bindValue(':user2Id', $user2Id);
        $stmt->bindValue(':conversationId', $conversationId);
        $stmt->bindValue(':message', $message);
        
        $stmt->execute();
        $stmt->closeCursor();

        header("Location: /../pages/conversation.php?user1Id=$user1Id&user2Id=$user2Id&itemId=$itemId");
        exit();
    } 
    else {
        die(header('Location: ../pages/index.php'));
    }
} else {
    header("Location: /../pages/index.php");
    exit();
}
?>
