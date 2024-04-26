<?php

class User {
    private $id;
    private $username;
    private $password;
    private $email;
    private $isAdmin;

    public function __construct($id, $username, $password, $email, $isAdmin = false) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->isAdmin = $isAdmin;
    }

    static function getAllUsers(PDO $db) : array {
        $stmt = $db->prepare('SELECT * FROM User');
        $stmt->execute();
    
        $users = array();
    
        while ($row = $stmt->fetch()) {
            // Create a User object for each row and add it to the users array
            $user = new User($row['Id'], $row['Username'], $row['Password'], $row['Email'], $row['Is_Admin']);
            $users[] = $user;
        }
    
        return $users;
    }
    




}
?>
