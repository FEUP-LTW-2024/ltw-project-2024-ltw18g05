<?php

Class Conversation {
    public int $id;
    public int $user1Id;
    public int $user2Id;
    public int $itemId;

    public function __construct($id, $user1Id, $user2Id, $itemId) {
        $this->id = $id;
        $this->user1Id = $user1Id;
        $this->user2Id = $user2Id;
        $this->itemId = $itemId;
    }

    public static function getConversation($user1Id, $user2Id, $itemId) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM conversation WHERE (user1_Id = :user1Id AND user2_Id = :user2Id AND item_Id = :itemId) OR (user1_Id = :user2Id AND user2_Id = :user1Id AND item_Id = :itemId)');
        $stmt->execute(['user1Id' => $user1Id, 'user2Id' => $user2Id, 'itemId' => $itemId]);
        $conversationData = $stmt->fetch();

        if ($conversationData !== false) {
            return new Conversation($conversationData['Id'], $conversationData['User1_Id'], $conversationData['User2_Id'], $conversationData['Item_Id']);
        }

    return null;
    }

    public static function getConversationId($user1Id, $user2Id, $itemId) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT Id FROM conversation WHERE (user1_Id = :user1Id AND user2_Id = :user2Id AND item_Id = :itemId) OR (user1_Id = :user2Id AND user2_Id = :user1Id AND item_Id = :itemId)');
        $stmt->execute(['user1Id' => $user1Id, 'user2Id' => $user2Id, 'itemId' => $itemId]);
        $conversationId = $stmt->fetch();
        return $conversationId;
    }

    public static function createConversation($user1Id, $user2Id, $itemId) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('INSERT INTO conversation (user1_Id, user2_Id, item_Id) VALUES (:user1Id, :user2Id, :itemId)');
        $stmt->execute(['user1Id' => $user1Id, 'user2Id' => $user2Id, 'itemId' => $itemId]);
    }

    public static function getConversations($userId) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('
            SELECT c.* 
            FROM Conversation c
            LEFT JOIN Message m ON c.Id = m.Conversation_Id
            WHERE c.User1_Id = :userId OR c.User2_Id = :userId
            GROUP BY c.Id
            ORDER BY MAX(m.Send_date) DESC
        ');
        $stmt->execute(['userId' => $userId]);
        $conversationsData = $stmt->fetchAll();
    
        $conversations = [];
        foreach ($conversationsData as $conversationData) {
            $conversations[] = new Conversation($conversationData['Id'], $conversationData['User1_Id'], $conversationData['User2_Id'], $conversationData['Item_Id']);
        }
        return $conversations;
    }

    public static function getMessages($conversationId) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM message WHERE conversation_Id = :conversationId');
        $stmt->execute(['conversationId' => $conversationId]);
        $messagesData = $stmt->fetchAll();
    
        $messages = [];
        foreach ($messagesData as $messageData) {
            $messages[] = new Message($messageData['Id'], $messageData['Sender_Id'], $messageData['Receiver_Id'], $messageData['Conversation_Id'], $messageData['Message_text'], $messageData['Send_date']);
        }
    
        return $messages;
    }
}
