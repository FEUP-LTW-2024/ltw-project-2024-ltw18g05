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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_id'])) {
    $catID = (int)$_POST['category_id'];

    $stmt_cat = $db->prepare('DELETE FROM Category WHERE Id = :id');
    $stmt_item = $db->prepare('DELETE FROM Item WHERE Category_Id = :id');

    $stmt_cat->bindParam(':id', $catID);
    $stmt_item->bindParam(':id', $catID);

    $stmt_cat->execute();
    $stmt_item->execute();

    // Redirect back to the manage users page to avoid resubmission
    header('Location: /pages/manageCategories.php');
    exit;
}
?>