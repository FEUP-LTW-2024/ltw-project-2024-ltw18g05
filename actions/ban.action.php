<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(dirname(__DIR__).'/database/session.class.php');
require_once(__DIR__ . '/../templates/common.tpl.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$db = getDatabaseConnection();
$session = new Session();
$allUsers = User::getAllUsers($db);

if ($session->isLoggedIn()) {
    $user = User::getUserFromId($db, $session->getId());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $userId = (int)$_POST['user_id'];

    $stmt_user = $db->prepare('DELETE FROM User WHERE Id = :id');
    $stmt_item = $db->prepare('DELETE FROM Item WHERE Seller_Id = :id');
    $stmt_conversation = $db->prepare('DELETE FROM Conversation WHERE User1_Id = :id OR User2_Id = :id');
    $stmt_message = $db->prepare('DELETE FROM Message WHERE Sender_Id = :id OR Receiver_Id = :id');
    $stmt_wishlist = $db->prepare('DELETE FROM Wishlist WHERE User_Id = :id');

    $stmt_user->bindParam(':id', $userId);
    $stmt_item->bindParam(':id', $userId);
    $stmt_conversation->bindParam(':id', $userId);
    $stmt_message->bindParam(':id', $userId);
    $stmt_wishlist->bindParam(':id', $userId);

    $stmt_user->execute();
    $stmt_item->execute();
    $stmt_conversation->execute();
    $stmt_message->execute();
    $stmt_wishlist->execute();

    // Redirect back to the manage users page to avoid resubmission
    header('Location: /pages/manageUsers.php');
    exit;
}
?>