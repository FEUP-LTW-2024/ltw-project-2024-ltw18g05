<?php
declare(strict_types=1);

require_once(__DIR__ . '/connection.db.php');

class Wishlist {
    public int $id;
    public int $userId;
    public int $itemId;

    public function __construct(int $id, int $userId, int $itemId) {
        $this->id = $id;
        $this->userId = $userId;
        $this->itemId = $itemId;
    }

    public static function getWishlistOfUserId(PDO $db, int $userId): array {
        $stmt = $db->prepare('SELECT Item_Id FROM Wishlist WHERE User_Id = ?');

        $stmt->execute([$userId]);

        $items = $stmt->fetchAll(PDO::FETCH_COLUMN);

        return $items;
    }

    public static function getItemsOfWishlistOfUser(PDO $db, int $userId): array {
        $stmt = $db->prepare('
            SELECT Item.*
            FROM Wishlist
            INNER JOIN Item ON Wishlist.Item_Id = Item.Id
            WHERE Wishlist.User_Id = ?
        ');

        $stmt->execute(array($userId));
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $items;
    }

    public static function removeItemFromWishlist(PDO $db, int $userId, int $itemId): bool {
        $stmt = $db->prepare('DELETE FROM Wishlist WHERE User_Id = ? AND Item_Id = ?');
        return $stmt->execute([$userId, $itemId]);
    }

}
?>
