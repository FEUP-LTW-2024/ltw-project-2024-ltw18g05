<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/wishlist.class.php');
require_once(dirname(__DIR__).'/database/session.class.php');

$session = new Session();
$db = getDatabaseConnection();

if (!$session->isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$itemId = $_POST['itemId'] ?? null;
$userId = $session->getId();

if ($itemId && Wishlist::removeItemFromWishlist($db, $userId, (int)$itemId)) {
    echo json_encode(['success' => true, 'message' => 'Item removed from wishlist']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to remove item']);
}

?>