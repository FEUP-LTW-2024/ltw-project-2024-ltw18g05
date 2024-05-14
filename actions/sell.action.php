<?php
declare(strict_types = 1);
require_once(dirname(__DIR__).'/database/session.class.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');
$session = new Session();



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["name"]) && isset($_POST["category"]) && isset($_POST["manufacturer"]) && isset($_POST["size"]) && isset($_POST["condition"]) && isset($_POST["description"]) && isset($_POST["price"])) {
        
        $db = getDatabaseConnection();

        $sellerId = $session->getId();
        $name = $_POST["name"];
        $categoryId = Item::getIdOfCategory($db, $_POST["category"]);
        $manufacturer = $_POST["manufacturer"];
        $size = $_POST["size"];
        $condition = $_POST["condition"];
        $description = $_POST["description"];
        $price = $_POST["price"];

        $session = new Session();

        $stmt = $db->prepare("INSERT INTO Item (Seller_Id, Category_Id, Manufacturer, Name, Size, Condition, Description, Price) VALUES (:sellerId, :categoryId, :manufacturer, :name, :size, :condition, :description, :price)");
        
        $stmt->bindValue(':sellerId', $sellerId);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':categoryId', $categoryId);
        $stmt->bindValue(':manufacturer', $manufacturer);
        $stmt->bindValue(':size', $size);
        $stmt->bindValue(':condition', $condition);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':price', $price);

        
        $stmt->execute();
        $stmt->closeCursor();

        $session->addMessage('success', "Item published!");
        header("Location: /../pages/profile.php");
        exit();
    } 
    else {
        $session->addMessage('warning', "All fields are required");
        die(header('Location: ../pages/sell.php'));
    }
} else {
    header("Location: /../pages/sell.php");
    exit();
}
?>