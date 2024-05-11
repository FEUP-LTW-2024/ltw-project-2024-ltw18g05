<?php 
require_once(__DIR__ . '/../templates/common.tpl.php'); 
require_once(__DIR__ . '/../database/connection.db.php');

require_once(__DIR__ . '/../database/item.class.php');
require_once(__DIR__ . '/../database/category.class.php');
require_once(__DIR__ . '/../templates/item.tpl.php'); 

$db = getDatabaseConnection();
    $items = Item::getAllItems($db);
    $categories = Category::getAllCategories($db);
?>



<?php
if(isset($_GET['id'])) {
    // Sanitize and validate the item ID
    $itemId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    

    // Fetch item details from the database based on $itemId
    // Replace this with your database query to fetch item details
    // Example:
    // $itemDetails = getItemDetailsFromDatabase($itemId);

    // Display item details
    // Example:
    // echo "<h1>{$itemDetails['name']}</h1>";
    // echo "<p>Price: {$itemDetails['price']}</p>";
    // echo "<p>Condition: {$itemDetails['condition']}</p>";
} else {
    // Redirect to a default page or display an error message
    // Example:
    header('Location: index.php');
    exit;
}
?>


















<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/item.css" rel="stylesheet">
    </head>
    <body>
        <?php drawHeader();?>
        <?php drawItemPage($items);?>
        <?php drawFooter();?>
    </body>
</html>