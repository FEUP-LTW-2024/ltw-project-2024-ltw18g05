<?php

class Message {
    public int $id;
    public int $senderId;
    public int $receiverId;
    public int $conversationId;
    public string $message;
    public string $timestamp;

    public function __construct($id, $senderId, $receiverId, $conversationId, $message, $timestamp) {
        $this->id = $id;
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->conversationId = $conversationId;
        $this->message = $message;
        $this->timestamp = $timestamp;
    }

    public static function getMessageCount($conversationId) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT COUNT(*) FROM Message WHERE Conversation_Id = :conversationId');
        $stmt->execute(['conversationId' => $conversationId]);
        $messageCount = $stmt->fetch();
        return (int)$messageCount['COUNT(*)'];
    }

    public static function getMostRecentMessage($conversationId) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM Message WHERE Conversation_Id = :conversationId ORDER BY Send_date DESC LIMIT 1');
        $stmt->execute(['conversationId' => $conversationId]);
        $messageData = $stmt->fetch();
        return new Message($messageData['Id'], $messageData['Sender_Id'], $messageData['Receiver_Id'], $messageData['Conversation_Id'], $messageData['Message_text'], $messageData['Send_date']);
    }

    public static function getUnopenedMessagesCount($userId) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('
            SELECT COUNT(*) 
            FROM Message m
            JOIN Conversation c ON m.Conversation_Id = c.Id
            WHERE (c.User1_Id = :userId OR c.User2_Id = :userId) AND m.Receiver_Id = :userId AND m.Opened = 0
        ');
        $stmt->execute(['userId' => $userId]);
        $unopenedMessagesCount = $stmt->fetch();
        return (int)$unopenedMessagesCount['COUNT(*)'];
    }

    public static function getConversationUnopenedMessagesCount($conversationId, $userId) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('
            SELECT COUNT(*) 
            FROM Message
            WHERE Conversation_Id = :conversationId AND Receiver_Id = :userId AND Opened = 0
        ');
        $stmt->execute(['conversationId' => $conversationId, 'userId' => $userId]);
        $unopenedMessagesCount = $stmt->fetch();
        return (int)$unopenedMessagesCount['COUNT(*)'];
    }

    public function openMessage() {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('UPDATE Message SET Opened = 1 WHERE Id = :messageId');
        $stmt->execute(['messageId' => $this->id]);
    }
}

?>
