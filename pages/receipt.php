<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');

    require_once(dirname(__DIR__).'/database/session.class.php');
    require_once(dirname(__DIR__).'/database/user.class.php');

    require_once(__DIR__ . '/../database/item.class.php');
    require_once(__DIR__ . '/../database/category.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/item.tpl.php'); 

    $db = getDatabaseConnection();
    $session = new Session();

    if ($session->isLoggedIn()) {
        $user = User::getUserFromId($db,$session->getId());}
    else {$user = null;}

    $itemId = $_POST['itemId'] ?? '';
    $time = $_POST['time'] ?? '';
    $itemBought = Item::getItemById($itemId);
    $seller = User::getUserById($itemBought->sellerId);

    Item::markItemAsSold($db, $itemBought->id, $session->getId());
?>

<!DOCTYPE html>
<html>
    <head>
        <title>PAYMENT RECEIPT - Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/receipt.css" rel="stylesheet">
    </head>
    <body>
        <table>
            <tr>
                <td><h1>Voyager</h1></td>
            </tr>
            <tr>
                <td><h1>PURCHASE INFORMATION</h1></td>
                <td><h1>ITEM INFORMATION</h1></td>
            </tr>
            <tr>
                <td><h2>Time of Purchase: <?= $time ?> </h2><td><h2>Name: <?= $itemBought->name ?> </h2></td>
            </tr>
            <tr>
                <td><h2>Seller's name: <?= $seller->name ?> </h2></td></td><td><h2>Price: <?= $itemBought->price ?>€ </h2></td>
            </tr>
            <tr>
                <td><h2>Seller's contact: <?= $seller->phone ?> </h2><td><h2>Condition: <?= $itemBought->condition ?> </h2></td>
            </tr>
            <tr>
                <td></td><td><h2>Manufacturer: <?= $itemBought->manufacturer ?> </h2></td>
            </tr>
            <tr>
                <td></td><td><h2>Size: <?= $itemBought->size ?> </h2></td>
            </tr>
            <tr>
                <td colspan="2"><h2>Shipping partners:</h2><img src="/images/others/CTT.png" alt="CTT"><img src="/images/others/LTW.png" alt="LTW"><img src="/images/others/AirCargo.png" alt="aircargo"></td>
            </tr>
        </table>
    </body>
</html>

