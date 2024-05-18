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
    $allItems = Item::getAllItems($db);
    if ($session->isLoggedIn()) {$user = User::getUserFromId($db,$session->getId());}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/manageItems.css" rel="stylesheet">
    </head>
    <body>

        <?php drawHeader($session, $user);?>
        <?php foreach ($allItems as $item) { ?>
            <section id="item">
                <img src="/images/items/<?=$item->imagePath?>" alt="">
                <h1><?= $item->name ?></h1>
                <h2><?= $item->sell ?></h2>
                <?php if($item->featured) { ?>
                    <form method="post" action="/actions/unfeature.action.php">
                        <input type="hidden" name="item_id" value="<?= $item->id ?>">
                        <button type="submit" name="action" value="unfeature">Unfeature</button>
                    </form>
                <?php } else { ?>
                    <form method="post" action="/actions/feature.action.php">
                        <input type="hidden" name="item_id" value="<?= $item->id ?>">
                        <button type="submit" name="action" value="feature">Feature Item</button>
                    </form>
                    
                    <form method="post" action="/actions/removeItemAdmin.action.php">
                        <input type="hidden" name="item_id" value="<?= $item->id ?>">
                        <button type="submit" name="action" value="remove">Remove Item</button>
                    </form>
                <?php } ?>
            </section>
        <?php }?>
        <?php drawFooter();?>
    </body>
</html>