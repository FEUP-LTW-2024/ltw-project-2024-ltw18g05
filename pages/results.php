<?php 
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(dirname(__DIR__).'/database/session.class.php');

    require_once(__DIR__ . '/../database/item.class.php');
    require_once(__DIR__ . '/../database/category.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/item.tpl.php'); 

    $db = getDatabaseConnection();
    $session = new Session();
    $items = Item::getAllItems($db);
    $categories = Category::getAllCategories($db);

    $search_content = $_GET['search_content'] ?? '';
    $condition_filter = $_GET['condition_filter'] ?? '';
    $category_filter = $_GET['category_filter'] ?? '';    
    $min_price_filter = isset($_GET['min_price_filter']) ? (float)$_GET['min_price_filter'] : null;
    $max_price_filter = isset($_GET['max_price_filter']) ? (float)$_GET['max_price_filter'] : null;
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/results.css" rel="stylesheet">
    </head>
    <body>

        <?php drawHeader($session);?>
        <?php drawNav($categories);?>

        <section id=results>
            <?php drawResultsHeader($categories, $search_content, $condition_filter, $min_price_filter, $max_price_filter, $category_filter);?>
            <?php drawResults($items, $categories, $search_content, $condition_filter, $min_price_filter, $max_price_filter, $category_filter);?>
        </section>

        <?php drawFooter();?>

    </body>
</html>