<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(dirname(__DIR__).'/database/session.class.php');
require_once(dirname(__DIR__).'/database/item.class.php');

$session = new Session();

if (!$session->isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$db = getDatabaseConnection();

$itemId = $_POST['item_id'] ?? null;

if ($itemId === null) {
    echo json_encode(['success' => false, 'message' => 'Item ID missing']);
    exit;
}

if (Item::removeItem($db, $itemId, $session->getId())) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to remove item']);
}
?>
