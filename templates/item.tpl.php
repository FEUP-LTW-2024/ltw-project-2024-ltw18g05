<?php 
  declare(strict_types = 1); 
  require_once(__DIR__ . '/../database/item.class.php')
?>


<?php function drawItems(array $items) { ?>
<section id=items>
    <h1><a href="item.html">Recently Posted</a></h1>
    <section id=items_articles>

        <?php foreach($items as $item) { ?> 
            <article>
                <h1><a href="item.html"><?=$item->name?></a></h1>
                <img src="/images/defaults/default2.jpg" alt="default">
                <footer>
                    <span class="price"><a href="item.php"><?=$item->price?></a></span>
                    <span class="condition"><a href="item.php"><?=$item->condition?></a></span>
                </footer>
            </article>
        <?php } ?>

    </section>
</section>
<?php } ?>