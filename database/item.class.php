<?php

class Item {
    private $id;
    private $sellerId;
    private $categoryId;
    private $manufacturer;
    private $name;
    private $size;
    private $condition;
    private $description;
    private $price;
    private $imagePath;

    public function __construct($id, $sellerId, $categoryId, $manufacturer, $name, $size, $condition, $description, $price, $imagePath) {
        $this->id = $id;
        $this->sellerId = $sellerId;
        $this->categoryId = $categoryId;
        $this->manufacturer = $manufacturer;
        $this->name = $name;
        $this->size = $size;
        $this->condition = $condition;
        $this->description = $description;
        $this->price = $price;
        $this->imagePath = $imagePath;
    }

    static function getAllItems(PDO $db) : array {
        $stmt = $db->prepare('SELECT * FROM Item');
        $stmt->execute();

        $items = array();

        while ($row = $stmt->fetch()) {
            // Create an Item object for each row and add it to the items array
            $item = new Item($row['Id'], $row['Seller_Id'], $row['Category_Id'], $row['Manufacturer'], $row['Name'], $row['Size'], $row['Condition'], $row['Description'], $row['Price'], $row['Image_path']);
            $items[] = $item;
        }

        return $items;
    }

    static function getItemsOfCategory(PDO $db, int $idOfcategory) : array {
        $stmt = $db->prepare('
            SELECT * FROM Item
            WHERE Category_Id = ?
            ORDER BY Name
            ');
        $stmt->execute(array($idOfcategory));

        $items = array();

        while ($row = $stmt->fetch()) {
            // Create an Item object for each row and add it to the items array
            $item = new Item($row['Id'], $row['Seller_Id'], $row['Category_Id'], $row['Manufacturer'], $row['Name'], $row['Size'], $row['Condition'], $row['Description'], $row['Price'], $row['Image_path']);
            $items[] = $item;
        }

        return $items;
    }


}
?>
