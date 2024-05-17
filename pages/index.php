<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');

    require_once(dirname(__DIR__).'/database/session.class.php');
    require_once(dirname(__DIR__).'/database/user.class.php');

    require_once(__DIR__ . '/../database/item.class.php');
    require_once(__DIR__ . '/../database/category.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/item.tpl.php'); 

    $db = getDatabaseConnection();
    $session = new Session();
    $items = Item::getAllItems($db);
    $categories = Category::getAllCategories($db);
    if ($session->isLoggedIn()) {
        $user = User::getUserFromId($db,$session->getId());}
    else {
        $user = null;
    }
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/style.css" rel="stylesheet">
    </head>
    <body>

        <?php drawHeader($session, $user);?>
        <?php drawNav($categories);?>

        <?php drawFeatured($items);?>
        
        <?php drawItems($items);?>

        <?php drawFooter();?>
        
    </body>
</html>
