<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');

    require_once(__DIR__ . '/../database/item.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/item.tpl.php'); 

    $db = getDatabaseConnection();
    $items = Item::getAllItems($db);
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/style.css" rel="stylesheet">
    </head>
    <body>

        <?php drawHeader();?>
        <?php drawNav();?>

        <?php drawFeatured($items);?>
        
        <?php drawItems($items);?>

        <?php drawFooter();?>
        
    </body>
</html>
