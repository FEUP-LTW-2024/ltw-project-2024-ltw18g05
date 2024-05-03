<?php 
  declare(strict_types = 1); 
  require_once(__DIR__ . '/../database/item.class.php')
?>



<!--Auxiliary functions-->

<?php function getCategoryName(array $categories, int $categoryId) : string {
    foreach ($categories as $category) {
        if ($category->id === $categoryId) {
            return $category->name;
        }
    }
    return ''; // Return empty string if category ID is not found
} ?>



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
                    <span class="price"><a href="item.php"><?=$item->price?>€</a></span>
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
                    <span class="price"><a href="item.php"><?=$item->price?>€</a></span>
                    <span class="condition"><a href="item.php"><?=$item->condition?></a></span>
                </footer>
            </article>

    <?php }
        }?>

    </section>
</section>
<?php } ?>



<!--results.php draw functions-->

<?php function drawResults(array $items, array $categories, string $search_content) { ?>
<section id=results>
    <h1><a>Results for</a></h1>
    <h2><a><?=$search_content?></a></h2>
    <section id=results_articles>

    <?php $search_content_lower = strtolower($search_content);
    
        foreach($items as $item) {
            $categoryId = $item->categoryId;
            $categoryName = getCategoryName($categories, $categoryId);
            
            $manufacturer_lower = strtolower($item->manufacturer);
            $name_lower = strtolower($item->name);
            $size_lower = strtolower($item->size);
            $condition_lower = strtolower($item->condition);
            $description_lower = strtolower($item->description);
            $categoryName_lower = strtolower($categoryName);
        
            if (strpos($manufacturer_lower, $search_content_lower) !== false ||
                strpos($name_lower, $search_content_lower) !== false ||
                strpos($size_lower, $search_content_lower) !== false ||
                strpos($condition_lower, $search_content_lower) !== false ||
                strpos($description_lower, $search_content_lower) !== false ||
                strpos($categoryName_lower, $search_content_lower) !== false) {?>

        <article>
            <img src="/images/defaults/default.jpg" alt="default">
            <h1><a href="item.php"><?=$item->name?></a></h1>
            <footer>
                <span class="price"><a href="item.php"><?=$item->price?>€</a></span>
                <span class="condition"><a href="item.php"><?=$item->condition?></a></span>
            </footer>
        </article>

    <?php }
        }?>

    </section>
</section>
<?php } ?>
