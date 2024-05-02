<?php 
  declare(strict_types = 1); 
  require_once(__DIR__ . '/../database/item.class.php')
?>


<!--index.php draw functions-->

<?php function drawFeatured(array $items) { ?>
<section id=featured>
    <h1><a href="item.html">Featured Items</a></h1>
    <section id=featured_articles>

        <?php foreach($items as $item) { 
                if($item->featured) {?>

            <article>
                <h1><a href="item.html"><?=$item->name?></a></h1>
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
    <h1><a href="item.html">Additional Items</a></h1>
    <section id=items_articles>

    <?php foreach($items as $item) { 
                if(!$item->featured) {?>

            <article>
                <h1><a href="item.html"><?=$item->name?></a></h1>
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

