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
    if ($session->isLoggedIn()) {$user = User::getUserFromId($db,$session->getId());}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/manageCategories.css" rel="stylesheet">
    </head>
    <body>
        <?php drawHeader($session, $user);?>
        <?php foreach ($categories as $category) { ?>
            <section id="category">
                <h1><?= $category->name ?></h1>
                <form method="post" action="/actions/removeCategory.action.php">
                    <input type="hidden" name="category_id" value="<?= $category->id ?>">
                    <button type="submit" name="action" value="remove">Remove Category</button>
                </form>
            </section>
        <?php }?>
        <?php drawFooter();?>
    </body>
</html>