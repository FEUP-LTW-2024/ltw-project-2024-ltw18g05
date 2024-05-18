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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    $itemID = (int)$_POST['item_id'];

    $stmt_item = $db->prepare('DELETE FROM Item WHERE Id = :id');
    $stmt_transaction = $db->prepare('DELETE FROM Transaction_ WHERE Item_Id = :id');
    $stmt_conversation = $db->prepare('DELETE FROM Conversation WHERE Item_Id = :id');
    $stmt_wishlist = $db->prepare('DELETE FROM Conversation WHERE Item_Id = :id');

    $stmt_item->bindParam(':id', $itemID);
    $stmt_transaction->bindParam(':id', $itemID);
    $stmt_conversation->bindParam(':id', $itemID);
    $stmt_wishlist->bindParam(':id', $itemID);

    $stmt_item->execute();
    $stmt_transaction->execute();
    $stmt_conversation->execute();
    $stmt_wishlist->execute();

    // Redirect back to the manage users page to avoid resubmission
    header('Location: /pages/manageItems.php');
    exit;
}
?>