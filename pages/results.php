<?php 
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');

    require_once(__DIR__ . '/../database/item.class.php');
    require_once(__DIR__ . '/../database/category.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/item.tpl.php'); 

    $db = getDatabaseConnection();
    $items = Item::getAllItems($db);
    $categories = Category::getAllCategories($db);

    $search_content=$_GET['search_content'];
    $condition_filter = $_GET['condition_filter'] ?? '';
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/results.css" rel="stylesheet">
    </head>
    <body>

        <?php drawHeader();?>
        <?php drawNav();?>

        <section id=results>
            <?php drawResultsHeader($search_content, $condition_filter);?>
            <?php drawResults($items, $categories, $search_content, $condition_filter);?>
        </section>

        <?php drawFooter();?>

    </body>
</html>