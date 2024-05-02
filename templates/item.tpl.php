<?php 
  declare(strict_types = 1); 
  require_once(__DIR__ . '/../database/item.class.php')
?>


<!--index.php draw functions-->

<?php function drawFeatured(array $items) { ?>
<section id=featured>
    <h1><a>Featured Items</a></h1>
    <section id=featured_articles>

        <?php foreach($items as $item) { 
                if($item->featured) {?>

            <article>
                <h1><a href="item.php"><?=$item->name?></a></h1>
                <img src="/images/defaults/default2.jpg" alt="default">
                <footer>
                    <span class="price"><a href="item.php"><?=$item->price?></a></span>
                    <span class="condition"><a href="item.php"><?=$item->condition?></a></span>
                </footer>
            </article>

        <?php }
            }?>

    </section>
</section>
<?php } ?>


<?php function drawItems(array $items) { ?>
<section id=items>
    <h1><a>Additional Items</a></h1>
    <section id=items_articles>

    <?php foreach($items as $item) { 
                if(!$item->featured) {?>

            <article>
                <h1><a href="item.php"><?=$item->name?></a></h1>
                <img src="/images/defaults/default2.jpg" alt="default">
                <footer>
                    <span class="price"><a href="item.php"><?=$item->price?></a></span>
                    <span class="condition"><a href="item.php"><?=$item->condition?></a></span>
                </footer>
            </article>

    <?php }
        }?>

    </section>
</section>
<?php } ?>


<!--results.php draw functions-->

<?php function drawResults(array $items, string $search_content) { ?>
<section id=results>
    <h1><a>Results for</a></h1>
    <h2><a><?=$search_content?></a></h2>
    <section id=results_articles>

    <?php foreach($items as $item) { 
                if (strpos($item->manufacturer, $search_content) !== false ||
                strpos($item->name, $search_content) !== false ||
                strpos($item->size, $search_content) !== false ||
                strpos($item->condition, $search_content) !== false ||
                strpos($item->description, $search_content) !== false) {?>

        <article>
            <img src="/images/defaults/default.jpg" alt="default">
            <h1><a href="item.php"><?=$item->name?></a></h1>
            <footer>
                <span class="price"><a href="item.php"><?=$item->price?></a></span>
                <span class="condition"><a href="item.php"><?=$item->condition?></a></span>
            </footer>
        </article>

    <?php }
        }?>

    </section>
</section>
<?php } ?>
