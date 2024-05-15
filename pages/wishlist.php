<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');

    require_once(__DIR__ . '/../database/category.class.php');
    require_once(__DIR__ . '/../database/item.class.php');
    require_once(__DIR__ . '/../database/wishlist.class.php');

    require_once(dirname(__DIR__).'/database/session.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/item.tpl.php');

    $db = getDatabaseConnection();
    $session = new Session();
    $categories = Category::getAllCategories($db);

    $items_of_wishlist = Wishlist::getItemsOfWishlistOfUser($db,$session->getId());
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/wishlist.css" rel="stylesheet">
    </head>
    <body>

        <?php drawHeader($session);?>
        <?php drawNav($categories);?>

        <?php drawItemsofWishlist($items_of_wishlist); ?>

        <?php drawFooter();?>
        
    </body>
</html>