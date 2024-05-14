<?php

class Item {
    public int $id;
    public int $sellerId;
    public int $categoryId;
    public string $manufacturer;
    public string $name;
    public string $size;
    public string $condition;
    public string $description;
    public $price;
    public $imagePath;
    public $featured;

    public function __construct($id, $sellerId, $categoryId, $manufacturer, $name, $size, $condition, $description, $price, $imagePath, $featured) {
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
        $this->featured = $featured;
    }

    static function getAllItems(PDO $db) : array {
        $stmt = $db->prepare('
        SELECT * FROM Item
        ');
        $stmt->execute();

        $items = array();

        while ($row = $stmt->fetch()) {
            // Create an Item object for each row and add it to the items array
            $item = new Item($row['Id'], $row['Seller_Id'], $row['Category_Id'], $row['Manufacturer'], $row['Name'], $row['Size'], $row['Condition'], $row['Description'], $row['Price'], $row['Image_path'], $row['Featured']);
            $items[] = $item;
        }

        return $items;
    }

    static function getItemsOfSellerUser(PDO $db, int $id) : array {
        $stmt = $db->prepare('
            SELECT * FROM Item
            WHERE Seller_Id = ?
            ORDER BY Name
            ');
        $stmt->execute(array($id));

        $items = array();

        while ($row = $stmt->fetch()) {
            // Create an Item object for each row and add it to the items array
            $item = new Item($row['Id'], $row['Seller_Id'], $row['Category_Id'], $row['Manufacturer'], $row['Name'], $row['Size'], $row['Condition'], $row['Description'], $row['Price'], $row['Image_path'], $row['Featured']);
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
            $item = new Item($row['Id'], $row['Seller_Id'], $row['Category_Id'], $row['Manufacturer'], $row['Name'], $row['Size'], $row['Condition'], $row['Description'], $row['Price'], $row['Image_path'], $row['Featured']);
            $items[] = $item;
        }

        return $items;
    }
    

}
?>
