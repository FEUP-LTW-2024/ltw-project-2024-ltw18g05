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
    $allUsers = User::getAllUsers($db);
    if ($session->isLoggedIn()) {$user = User::getUserFromId($db,$session->getId());}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/manageUsers.css" rel="stylesheet">
    </head>
    <body>

        <?php drawHeader($session, $user);?>
        <?php foreach ($allUsers as $person) { ?>
            <section id="user">
            <img src="/images/profilepictures/<?=$person->profilepicture ?>.png" alt="">
            <h1><?= $person->name ?></h1>
            <h2><?= $person->email ?></h2>
            <?php if($person->id != $user->id) {
                if($person->isAdmin) { ?>
                    <form method="post" action="/actions/demote.action.php">
                        <input type="hidden" name="user_id" value="<?= $person->id ?>">
                        <button type="submit" name="action" value="demote">Demote Admin</button>
                    </form>
                <?php } else { ?>
                    <form method="post" action="/actions/promote.action.php">
                        <input type="hidden" name="user_id" value="<?= $person->id ?>">
                        <button type="submit" name="action" value="promote">Promote to Admin</button>
                    </form>
                    <form method="post" action="/actions/ban.action.php">
                        <input type="hidden" name="user_id" value="<?= $person->id ?>">
                        <button type="submit" name="action" value="ban">Ban</button>
                    </form>
                <?php }
                } else {?>
                    <h1>You're Him!</h1>
                <?php } ?>
            </section>
        <?php }?>
        <?php drawFooter();?>
    </body>
</html>