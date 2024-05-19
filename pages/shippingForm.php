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
    $itemBought = Item::getItemById($itemId);
    $seller = User::getUserById($itemBought->sellerId);
    $buyer = User::getUserById($itemBought->buyerId);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>SHIPPING FORM - Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/receiptShipping.css" rel="stylesheet">
    </head>
    <body>
        <table>
            <tr>
                <td><h1>SHIPPING INFORMATION - Voyager I.C.G.</h1></td><td id="barcode"><h1>VoyagerInternational<?= $itemBought->id ?><?= $itemBought->sellerId ?><?= $itemBought->buyerId ?></h1></td>
            </tr>
            <tr>
                <td><h1>SENDER</h1></td><td><h1>RECIPIENT</h1></td>
            </tr>
            <tr>
                <td><h2>Name: <?= $seller->name ?> </h2></td></td><td><h2>Name: <?= $buyer->name ?> </h2></td></td>
            </tr>
            <tr>
                <td><h2>Address: <?= $seller->address ?> </h2></td></td><td><h2>Address: <?= $buyer->address ?> </h2></td></td>
            </tr>
            <tr>
                <td><h2>Contact: <?= $seller->phone ?> </h2><td><h2>Contact: <?= $buyer->phone ?> </h2>
            </tr>
            <tr>
                <td colspan="2"><h2>Shipping partners:</h2><img src="/images/others/CTT.png" alt="CTT"><img src="/images/others/LTW.png" alt="LTW"><img src="/images/others/AirCargo.png" alt="aircargo"></td>
            </tr>
        </table>
    </body>
</html>

