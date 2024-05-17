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

    $stmt = $db->prepare('UPDATE Item SET Featured = 0 WHERE Id = :id');
    $stmt->bindParam(':id', $itemID);
    $stmt->execute();

    // Redirect back to the manage users page to avoid resubmission
    header('Location: /pages/manageItems.php');
    exit;
}
?>