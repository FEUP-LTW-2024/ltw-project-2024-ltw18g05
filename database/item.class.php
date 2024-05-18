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
    public bool $isSold;
    public $buyerId;

    public function __construct($id, $sellerId, $categoryId, $manufacturer, $name, $size, $condition, $description, $price, $imagePath, $featured, $isSold, $buyerId) {
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
        $this->isSold = $isSold;
        $this->buyerId = $buyerId;
    }

    static function getAllItems(PDO $db) : array {
        $stmt = $db->prepare('
        SELECT * FROM Item
        ');
        $stmt->execute();

        $items = array();

        while ($row = $stmt->fetch()) {
            // Create an Item object for each row and add it to the items array
            $item = new Item($row['Id'], $row['Seller_Id'], $row['Category_Id'], $row['Manufacturer'], $row['Name'], $row['Size'], $row['Condition'], $row['Description'], $row['Price'], $row['Image_path'], $row['Featured'], $row['Is_Sold'], $row['Buyer_Id']);
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
            $item = new Item($row['Id'], $row['Seller_Id'], $row['Category_Id'], $row['Manufacturer'], $row['Name'], $row['Size'], $row['Condition'], $row['Description'], $row['Price'], $row['Image_path'], $row['Featured'], $row['Is_Sold'], $row['Buyer_Id']);
            $items[] = $item;
        }

        return $items;
    }


    static function getIdOfCategory(PDO $db, string $nameOfCategory) {
        $query = "SELECT Id FROM Category WHERE Name = :name";
        $statement = $db->prepare($query);
        $statement->bindParam(':name', $nameOfCategory, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['Id'];
        } else {
            return null;
        }
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
            $item = new Item($row['Id'], $row['Seller_Id'], $row['Category_Id'], $row['Manufacturer'], $row['Name'], $row['Size'], $row['Condition'], $row['Description'], $row['Price'], $row['Image_path'], $row['Featured'], $row['Is_Sold'], $row['Buyer_Id']);
            $items[] = $item;
        }

        return $items;
    }
    
    static function getItemById($id) : ?Item {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM Item WHERE Id = ?');
        $stmt->execute(array($id));

        if ($item = $stmt->fetch()) {
            return new Item(
                $item['Id'],
                $item['Seller_Id'],
                $item['Category_Id'],
                $item['Manufacturer'],
                $item['Name'],
                $item['Size'],
                $item['Condition'],
                $item['Description'],
                $item['Price'],
                $item['Image_path'],
                $item['Featured'],
                $item['Is_Sold'],
                $item['Buyer_Id']
            );
        } else return null;
    }

    public static function removeItem(PDO $db, $itemId, $userId): bool {
        $stmt = $db->prepare('DELETE FROM Item WHERE Id = ? AND Seller_Id = ?');
        return $stmt->execute([$itemId, $userId]);
    }

    public static function markItemAsSold(PDO $db, int $itemId, int $buyerId): bool {
        $stmt = $db->prepare('UPDATE Item SET Is_Sold = TRUE, Buyer_Id = ? WHERE Id = ?');
        return $stmt->execute([$buyerId, $itemId]);
    }

}
?>
