<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/category.class.php');
    require_once(__DIR__ . '/../database/item.class.php');
    require_once(dirname(__DIR__).'/database/user.class.php');
    require_once(dirname(__DIR__).'/database/session.class.php');
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/item.tpl.php');

    $db = getDatabaseConnection();
    $session = new Session();
    $categories = Category::getAllCategories($db);

    $itemsForSale = Item::getItemsOfSellerUser($db,$session->getId());
    if ($session->isLoggedIn()) {$user = User::getUserFromId($db,$session->getId());}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/admin.css" rel="stylesheet">
    </head>
    <body>
        <?php drawHeader($session, $user);?>
        <ul>
            <span style="font-size: 1.5em;">Admin Option Thing</span>
            <li><a href="createCategory.php">Add new Category</a></li>
            <li><a href="manageUsers.php">Manage Users</a></li>
            <li><a href="manageItems.php">Manage Items</a></li>
        </ul>

        
        <?php drawFooter();?>
    </body>
</html>