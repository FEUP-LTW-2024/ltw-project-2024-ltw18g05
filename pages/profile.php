<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');

    require_once(__DIR__ . '/../database/category.class.php');
    require_once(__DIR__ . '/../database/item.class.php');

    require_once(dirname(__DIR__).'/database/session.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/item.tpl.php');

    $db = getDatabaseConnection();
    $session = new Session();
    $categories = Category::getAllCategories($db);

    $itemsForSale = Item::getItemsOfSellerUser($db,$session->getId());
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/profile.css" rel="stylesheet">
    </head>
    <body>

        <?php drawHeader($session);?>
        <?php drawNav($categories);?>

        <section id="profileimage_maininfo">

            <img src="/images/anonymous.png" alt="anonymous">

            <section id=maininfo>
                <h1><a href="profile.php"><?= $session->getName() ?></a></h1>
                <h2><a href="profile.php"><?= $session->getUsername() ?></a></h2>
                <h2><a href="profile.php"><?= $session->getEmail() ?></a></h2>
            </section>

        </section>

        <section id=sell_item>
            <h1><a href="sell.php">Place New Item to Sell!</a></h1>
        </section>

        <?php if (count($itemsForSale) != 0) {
            drawItemsofSellerUser($itemsForSale);
        } ?>

        <?php drawFooter();?>
        
    </body>
</html>