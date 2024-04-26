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

        <section id=featured>
            <h1><a href="item.html">Featured Items</a></h1>
            <section id=featured_articles>
                <article>
                    <h1><a href="item.php">Quisque a dapibus magna, non scelerisque aaaaaaaaaa aaaaaaaaa aaaaaaaaa aaaaaaaaaa aaaaaaaaa aaaaaaaaa</a></h1>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <h1><a href="item.php">Item Placement</a></h1>
                    <img src="/images/defaults/default2.jpg" alt="default">
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <h1><a href="item.php">Item Placement</a></h1>
                    <img src="/images/defaults/default3.jpeg" alt="default">
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
            </section>
        </section>
        
        <?php drawItems($items);?>

        <!--<section id=items>
            <h1><a href="item.html">Recently Posted</a></h1>
            <section id=items_articles>
                <article>
                    <h1><a href="item.html">Quisque a dapibus magna, non scelerisque</a></h1>
                    <img src="/images/defaults/default2.jpg" alt="default">
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <h1><a href="item.php">Item Placement</a></h1>
                    <img src="/images/defaults/default3.jpeg" alt="default">
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <h1><a href="item.php">Item Placement</a></h1>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <h1><a href="item.php">Item Placement</a></h1>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <h1><a href="item.php">Item Placement</a></h1>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <h1><a href="item.html">Quisque a dapibus magna, non scelerisque</a></h1>
                    <img src="/images/defaults/default2.jpg" alt="default">
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <h1><a href="item.php">Item Placement</a></h1>
                    <img src="/images/defaults/default3.jpeg" alt="default">
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <h1><a href="item.php">Item Placement</a></h1>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <h1><a href="item.php">Item Placement</a></h1>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <h1><a href="item.php">Item Placement</a></h1>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <h1><a href="item.php">Item Placement</a></h1>
                    <img src="/images/defaults/default.jpg" alt="default">
                    <footer>
                        <span class="price"><a href="item.php">19.99€</a></span>
                        <span class="condition"><a href="item.php">Very Good</a></span>
                    </footer>
                </article>
                <article>
                    <h1><a href="item.php">Item Placement</a></h1>
                    <img src="/images/defaults/default.jpg" alt="default">
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
