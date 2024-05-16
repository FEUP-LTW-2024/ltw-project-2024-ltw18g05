<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');

    require_once(__DIR__ . '/../database/category.class.php');
    require_once(__DIR__ . '/../database/item.class.php');
    require_once(__DIR__ . '/../database/wishlist.class.php');

    require_once(dirname(__DIR__).'/database/session.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/item.tpl.php');
    require_once(dirname(__DIR__).'/database/user.class.php');

    $db = getDatabaseConnection();
    $session = new Session();
    $categories = Category::getAllCategories($db);

    $items_of_wishlist = Wishlist::getItemsOfWishlistOfUser($db,$session->getId());
    if ($session->isLoggedIn()) {$user = User::getUserFromId($db,$session->getId());}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/wishlist.css" rel="stylesheet">
        <script>
        function removeFromWishlist(itemId) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/actions/removeOfWishlist.action.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        console.log(response);
                        document.getElementById('item-' + itemId).remove();
                    } else {
                        alert(response.message);
                    }
                }
            };

            xhr.send('itemId=' + itemId);
        }
    </script>
    </head>
    <body>

        <?php drawHeader($session, $user);?>
        <?php drawNav($categories);?>

        <?php drawItemsofWishlist($items_of_wishlist); ?>

        <?php drawFooter();?>
        
    </body>
</html>