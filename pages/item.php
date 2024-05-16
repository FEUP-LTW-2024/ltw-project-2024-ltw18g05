<?php 
require_once(__DIR__ . '/../templates/common.tpl.php'); 
require_once(__DIR__ . '/../database/connection.db.php');
require_once(dirname(__DIR__).'/database/session.class.php');
require_once(__DIR__ . '/../database/item.class.php');
require_once(__DIR__ . '/../database/category.class.php');
require_once(dirname(__DIR__).'/database/user.class.php');
require_once(__DIR__ . '/../templates/item.tpl.php'); 

$db = getDatabaseConnection();
$session = new Session();
$items = Item::getAllItems($db);
$categories = Category::getAllCategories($db);
if ($session->isLoggedIn()) {$user = User::getUserFromId($db,$session->getId());}
?>



<?php
if(isset($_GET['id'])) {
    $itemId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
} else {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/item.css" rel="stylesheet">
    </head>
    <body>
        <?php drawHeader($session, $user);?>
        <?php drawItemPage($items, $session);?>
        <?php drawFooter();?>
    </body>
</html>