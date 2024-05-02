<?php 
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');

    require_once(__DIR__ . '/../database/item.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/item.tpl.php'); 

    $db = getDatabaseConnection();
    $items = Item::getAllItems($db);

    $search_content=$_GET['search_content'];
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

        <?php drawResults($items,$search_content);?>

        <!--<section id=results>
            <h1><a>Results for</a></h1>
            <h2><a>the thing that was searched</a></h2>
            <section id=results_articles>
                <article>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <h1><a href="item.php">Quisque a dapibus magna, non scelerisque</a></h1>
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <h1><a href="item.php">Item Placement</a></h1>
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <h1><a href="item.php">Quisque a dapibus magna, non scelerisque</a></h1>
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <h1><a href="item.php">Item Placement</a></h1>
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <h1><a href="item.php">Quisque a dapibus magna, non scelerisque</a></h1>
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <h1><a href="item.php">Item Placement</a></h1>
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <h1><a href="item.php">Quisque a dapibus magna, non scelerisque</a></h1>
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <h1><a href="item.php">Item Placement</a></h1>
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
            </section>
        </section>-->

        <?php drawFooter();?>

    </body>
</html>