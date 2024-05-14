<?php
declare(strict_types = 1);
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(dirname(__DIR__).'/database/session.class.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/category.class.php');

    $session = new Session();

    $db = getDatabaseConnection();
    $categories = Category::getAllCategories($db);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sell Item - Voyager</title>
    <meta charset="UTF-8">
    <link href="/css/sell.css" rel="stylesheet">
</head>
<body>
    
    <?php drawHeader($session);?>

    <div class="register-container">
        <form action="../actions/sell.action.php" method="post">
            <h2>Fill up the information of the item to sell.</h2>

            <div class="input-container">
                <label for="name">Name:</label>
                <input type="name" id="name" name="name" required>
            </div>

            <div class="input-container">
                <label for="category">Category:</label>
                <select name="category">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->name ?>"><?= $category->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-container">
                <label for="manufacturer">Manufacturer:</label>
                <input type="manufacturer" id="manufacturer" name="manufacturer" required>
            </div>

            <div class="input-container">
                <label for="size">Size:</label>
                <input name="size" list="size" value="N/A" required>
                    <datalist id="size">
                        <option selected>N/A</option>
                    </datalist>
            </div>

            <div class="input-container">
                <label for="condition">Condition:</label>
                <select name="condition" required>
                    <option value="Excellent">Excellent</option>
                    <option value="Good">Good</option>
                    <option value="Bad">Bad</option>
                    <option value="Deteriorated">Deteriorated</option>
                </select>
            </div>

            <div class="input-container">
                <label for="description">Description:</label>
                <input type="description" id="description" name="description" required>
            </div>

            <div class="input-container">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" value="0" step="0.5" required>
            </div>

            <button type="submit">Publish Item</button>
        </form>
    </div>

    <?php drawFooter();?>

</body>
</html>