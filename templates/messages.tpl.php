<?php 
  declare(strict_types = 1); 
  require_once(__DIR__ . '/../database/conversation.class.php');
  require_once(__DIR__ . '/../database/message.class.php');
  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/item.class.php');
?>

<?php function drawConversation($user1Id, $user2Id, $itemId, $session) { 
    if ($session->getID() === $user1Id) {
        $otherUser = User::getUserById($user2Id);
    }
    else {
        $otherUser = User::getUserById($user1Id);
    }
    $item = Item::getItemById($itemId);
    ?>
    <h1>Conversation with <?= $otherUser->username ?> about <?= $item->name ?></h1>
    <a href="../pages/item.php?id=<?= $itemId ?>" class="item-link">
        <img class="item-image" src="<?= $item->imagePath ?>" alt="Item Image">
    </a>
    <div id="messages">
        <?php
        $conversation = Conversation::getConversation($user1Id, $user2Id, $itemId);
        if (!$conversation) {
            Conversation::createConversation($user1Id, $user2Id, $itemId);
            $conversation = Conversation::getConversation($user1Id, $user2Id, $itemId);
        }
        $messages = Conversation::getMessages($conversation->id);
        foreach ($messages as $message) {
            drawMessage($message, $session);
        }
        ?>
    </div>
    <form id="messageForm" action="/api/sendMessage.php" method="post">
        <input type="hidden" name="user1Id" value="<?php echo $user1Id; ?>">
        <input type="hidden" name="user2Id" value="<?php echo $user2Id; ?>">
        <input type="hidden" name="itemId" value="<?php echo $itemId; ?>">
        <textarea name="message" placeholder="Type your message here"></textarea>
        <button type="submit">Send</button>
    </form>
<?php } ?>

<?php function drawMessage(Message $message, Session $session) {
    $sender = User::getUserById($message->senderId);
    $receiver = User::getUserById($message->receiverId);
    $isSender = $session->getId() == $message->senderId;
    ?>
    <div class="message <?php echo $isSender ? 'sent' : 'received'; ?>">
        <img class="profile-picture" src="/images/profilepictures/<?= $isSender ? $sender->profilepicture : $receiver->profilepicture; ?>.png" alt="Profile Picture">
            <div class="message-content">
                <p><?php echo $message->message; ?></p>
                <span><?php echo $message->timestamp; ?></span>
            </div>
    </div>
<?php } ?>
