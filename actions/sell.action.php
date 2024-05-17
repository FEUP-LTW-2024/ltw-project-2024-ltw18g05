<?php
declare(strict_types=1);

require_once(dirname(__DIR__) . '/database/session.class.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');

$session = new Session();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["name"]) && isset($_POST["category"]) && isset($_POST["manufacturer"]) && isset($_POST["size"]) && isset($_POST["condition"]) && isset($_POST["description"]) && isset($_POST["price"])) {

        $db = getDatabaseConnection();

        $sellerId = $session->getId();
        $itemName = $_POST["name"];
        $categoryId = Item::getIdOfCategory($db, $_POST["category"]);
        $manufacturer = $_POST["manufacturer"];
        $size = $_POST["size"];
        $condition = $_POST["condition"];
        $description = $_POST["description"];
        $price = $_POST["price"];

        // Check if a file was uploaded
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            // Process the file upload
            $tmp_name = $_FILES['profile_picture']['tmp_name'];
            $filename = basename($_FILES['profile_picture']['name']);
            $newFilename = $session->getID() . $filename;
            $upload_dir = __DIR__ . '/../images/items/';
            $target_file = $upload_dir . $newFilename;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($tmp_name, $target_file)) {
                // File moved successfully
                $image_url = '/images/items/' . $newFilename;
            } else {
                // Error moving file
                $session->addMessage('error', "Error uploading file.");
                header('Location: ../pages/sell.php');
                exit();
            }
        } else {
            // No file uploaded or error occurred
            $image_url = null;
        }

        // Insert the item into the database
        $stmt = $db->prepare("INSERT INTO Item (Seller_Id, Category_Id, Manufacturer, Name, Size, Condition, Description, Price, Image_path) VALUES (:sellerId, :categoryId, :manufacturer, :itemName, :size, :condition, :description, :price, :image_url)");
        $stmt->bindValue(':sellerId', $sellerId);
        $stmt->bindValue(':itemName', $itemName);
        $stmt->bindValue(':categoryId', $categoryId);
        $stmt->bindValue(':manufacturer', $manufacturer);
        $stmt->bindValue(':size', $size);
        $stmt->bindValue(':condition', $condition);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':image_url', $image_url);

        $stmt->execute();
        $stmt->closeCursor();

        $session->addMessage('success', "Item published!");
        header("Location: ../pages/profile.php");
        exit();
    } else {
        $session->addMessage('warning', "All fields are required");
        header('Location: ../pages/sell.php');
        exit();
    }
} else {
    header('Location: ../pages/sell.php');
    exit();
}
?>
