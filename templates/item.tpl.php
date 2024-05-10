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

<?php 
function drawResultsHeader(array $categories, string $search_content, string $condition_filter, ?float $min_price_filter, ?float $max_price_filter, ?string $category_filter) { 
    ?>
    <section id="results_header">
        <section id="resultsfor">
            <h1><a>Results for</a></h1>
            <h2><a><?= $search_content ?></a></h2>
        </section>
        <form id="filters_form" action="results.php" method="get">
            <label for="condition_filter">Condition:</label>
            <select name="condition_filter">
                <option value="" <?= $condition_filter === '' ? 'selected' : '' ?>>Any</option>
                <option value="Excellent" <?= $condition_filter === 'Excellent' ? 'selected' : '' ?>>Excellent</option>
                <option value="Good" <?= $condition_filter === 'Good' ? 'selected' : '' ?>>Good</option>
                <option value="Bad" <?= $condition_filter === 'Bad' ? 'selected' : '' ?>>Bad</option>
                <option value="Deteriorated" <?= $condition_filter === 'Deteriorated' ? 'selected' : '' ?>>Deteriorated</option>
            </select>

            <label for="min_price_filter">Min Price:</label>
            <input type="number" id="min_price_filter" name="min_price_filter" value="<?= $min_price_filter ?? '' ?>" step="0.5">
            <label for="max_price_filter">Max Price:</label>
            <input type="number" id="max_price_filter" name="max_price_filter" value="<?= $max_price_filter ?? '' ?>" step="0.5">

            <label for="category_filter">Category:</label>
            <select name="category_filter">
                <option value="" <?= $category_filter === '' ? 'selected' : '' ?>>Any</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->name ?>" <?= $category_filter === $category->name ? 'selected' : '' ?>><?= $category->name ?></option>
                <?php endforeach; ?>
            </select>

            <input type="hidden" name="search_content" value="<?= htmlspecialchars($search_content) ?>">
            <button type="submit">Apply Filter</button>
            <button type="button" onclick="window.location.href='results.php?search_content=<?= $search_content ?>'">Reset Filters</button>
        </form>
    </section>
<?php 
} 
?>


<?php 
function drawResults(array $items, array $categories, string $search_content, string $condition_filter, ?float $min_price_filter, ?float $max_price_filter, ?string $category_filter) { 
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
            
            // Check if item matches search content, condition filter, price range, and category filter
            $matches_search_content = strpos($manufacturer_lower, $search_content_lower) !== false ||
                                      strpos($name_lower, $search_content_lower) !== false ||
                                      strpos($size_lower, $search_content_lower) !== false ||
                                      strpos($condition_lower, $search_content_lower) !== false ||
                                      strpos($description_lower, $search_content_lower) !== false ||
                                      strpos($categoryName_lower, $search_content_lower) !== false;

            $matches_condition_filter = $condition_filter_lower === '' || $condition_filter_lower === 'any' || $condition_lower === $condition_filter_lower;

            $within_price_range = ($min_price_filter === null || $item->price >= $min_price_filter) && ($max_price_filter === null || $item->price <= $max_price_filter);

            $matches_category_filter = $category_filter === '' || $categoryName_lower === strtolower($category_filter);

            if ($matches_search_content && $matches_condition_filter && $within_price_range && $matches_category_filter) {
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


