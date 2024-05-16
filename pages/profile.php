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
        <link href="/css/profile.css" rel="stylesheet">
    </head>
    <body>

        <?php drawHeader($session, $user);?>
        <?php drawNav($categories);?>

        <section id="profileimage_maininfo">

            <img src="/images/profilepictures/<?= $user->profilepicture ?>.png" alt="anonymous">

            <section id=maininfo>
                <h1><a href="profile.php"><?= $user->name ?></a></h1>
                <h2><a href="profile.php"><?= $user->username ?></a></h2>
                <h2><a href="profile.php"><?= $user->email ?></a></h2>
                <h2><a id="edit_profile" href="editregister.php">Edit Profile</a></h2>
            </section>

        </section>

        <?php if (count($itemsForSale) != 0) {
            drawItemsofSellerUser($itemsForSale);
        } ?>
        
        <section id=sell_item>
            <h1><a href="sell.php">Place New Item to Sell!</a></h1>
        </section>

        <?php drawFooter();?>
        
    </body>
</html>