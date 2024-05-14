<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');

    require_once(__DIR__ . '/../database/category.class.php');

    require_once(dirname(__DIR__).'/database/session.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');

    $db = getDatabaseConnection();
    $session = new Session();
    $categories = Category::getAllCategories($db);
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
                <h1><a href="profile.php">John Human</a></h1>
                <h2><a href="profile.php">johnhuman1234</a></h2>
                <h2><a href="profile.php">jonhhumaniscool@gmail.com</a></h2>
            </section>

        </section>


        <?php drawFooter();?>
        
    </body>
</html>