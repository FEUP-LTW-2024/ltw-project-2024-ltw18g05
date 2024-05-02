<?php

class Category {
    public int $id;
    public string $name;

    public function __construct($id,$name) {
        $this->id = $id;
        $this->name = $name;
    }

    static function getAllCategories(PDO $db) : array {
        $stmt = $db->prepare('
        SELECT * FROM Category
        ');
        $stmt->execute();

        $categories = array();

        while ($row = $stmt->fetch()) {
            // Create an Category object for each row and add it to the categories array
            $category = new Category($row['Id'],$row['Name']);
            $categories[] = $category;
        }

        return $categories;
    }

}
?>