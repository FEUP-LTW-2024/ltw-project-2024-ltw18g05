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
    <div id="message-list">
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
    <form id="messageForm" action="/../actions/sendMessage.action.php" method="post">
        <input type="hidden" name="user1Id" value="<?php echo $session->getID(); ?>">
        <input type="hidden" name="user2Id" value="<?php echo $otherUser->id; ?>">
        <input type="hidden" name="itemId" value="<?php echo $itemId; ?>">
        <input type="hidden" name="conversationId" value="<?php echo $conversation->id; ?>">
        <textarea name="message" placeholder="Type your message here"></textarea>
        <button type="submit">Send</button>
    </form>
<?php } ?>

<?php function drawMessage(Message $message, Session $session) {
    if ($message->receiverId == $session->getId()) {
        $message->openMessage();
    }
    $sender = User::getUserById($session->getId());
    $isSender = $session->getId() == $message->senderId;
    ?>
    <div class="message <?php echo $isSender ? 'sent' : 'received'; ?>">
        <img class="profile-picture" src="/images/profilepictures/<?= $sender->profilepicture ?>.png" alt="Profile Picture">
            <div class="message-content">
                <p><?php echo $message->message; ?></p>
                <span><?php echo $message->timestamp; ?></span>
            </div>
    </div>
<?php } ?>

<?php function drawConversations($userId) {
    $conversations = Conversation::getConversations($userId);
    foreach ($conversations as $conversation) {
        $messageCount = Message::getMessageCount($conversation->id);
        if ($messageCount == 0) {
            continue;
        }
        $mostRecentMessage = Message::getMostRecentMessage($conversation->id);
        $otherUser = User::getUserById($conversation->user1Id == $userId ? $conversation->user2Id : $conversation->user1Id);
        $item = Item::getItemById($conversation->itemId);
        $unopenedMessagesCount = Message::getConversationUnopenedMessagesCount($conversation->id, $userId);
        ?>
        <a href="/pages/conversation.php?user1Id=<?= $conversation->user1Id ?>&user2Id=<?= $conversation->user2Id ?>&itemId=<?= $conversation->itemId ?>">
            <div class="conversation">
                <img class="profile-picture" src="/images/profilepictures/<?= $otherUser->profilepicture ?>.png" alt="Profile Picture">
                <div class="conversation-content">
                    <h2><?= $otherUser->username ?></h2>
                    <p><?= $mostRecentMessage->message ?></p>
                    <p><?= $item->name ?></p>
                </div>
                <?php if ($unopenedMessagesCount > 0) { ?>
                    <p class="conversation-notification"><?= $unopenedMessagesCount ?></p>
                <?php } ?>
            </div>
        </a>
    <?php }
} ?>
