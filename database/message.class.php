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
}

?>