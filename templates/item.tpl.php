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
                <img src=<?=$item->imagePath?> alt="imagePath">
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
                <img src=<?=$item->imagePath?> alt="imagePath">
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

<?php function drawResultsHeader(string $search_content, string $condition_filter) { ?>

<section id=results_header>
    <section id=resultsfor>
        <h1><a>Results for</a></h1>
        <h2><a><?=$search_content?></a></h2>
    </section>
    <form id="filters_form" action="results.php" method="get">

        <h2><a>Condition:</a></h2>
        <input type="radio" id="excellent" name="condition_filter" value="Excellent">
        <label for="excellent">Excellent</label>
        <input type="radio" id="good" name="condition_filter" value="Good">
        <label for="good">Good</label>
        <input type="radio" id="bad" name="condition_filter" value="Bad">
        <label for="bad">Bad</label>
        <input type="radio" id="deteriorated" name="condition_filter" value="Deteriorated">
        <label for="deteriorated">Deteriorated</label>

        <input type="hidden" name="search_content" value="<?= htmlspecialchars($search_content) ?>">
        <button type="submit">Apply Filter</button>
    </form>
</section>

<?php } ?>



<?php 
function drawResults(array $items, array $categories, string $search_content, string $condition_filter) { 
    ?>
    <section id="results_articles">
        <?php 
        $search_content_lower = strtolower($search_content);
        $condition_filter_lower = strtolower($condition_filter);
        
        foreach($items as $item) {
            $categoryId = $item->categoryId;
            $categoryName = getCategoryName($categories, $categoryId);
            
            $manufacturer_lower = strtolower($item->manufacturer);
            $name_lower = strtolower($item->name);
            $size_lower = strtolower($item->size);
            $condition_lower = strtolower($item->condition);
            $description_lower = strtolower($item->description);
            $categoryName_lower = strtolower($categoryName);
            
            // Check if item matches search content and condition filter
            if ((strpos($manufacturer_lower, $search_content_lower) !== false ||
                strpos($name_lower, $search_content_lower) !== false ||
                strpos($size_lower, $search_content_lower) !== false ||
                strpos($condition_lower, $search_content_lower) !== false ||
                strpos($description_lower, $search_content_lower) !== false ||
                strpos($categoryName_lower, $search_content_lower) !== false) &&
                ($condition_filter_lower === '' || $condition_lower === $condition_filter_lower)) {
                ?>
                <article>
                    <img src="<?= $item->imagePath ?>" alt="default">
                    <h1><a href="item.php"><?= $item->name ?></a></h1>
                    <footer>
                        <span class="price"><a href="item.php"><?= $item->price ?>€</a></span>
                        <span class="condition"><a href="item.php"><?= $item->condition ?></a></span>
                    </footer>
                </article>
                <?php
            }
        }
        ?>
    </section>
<?php 
} 
?>

