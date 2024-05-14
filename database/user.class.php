<?php

class User {
    public int $id;
    public string $username;
    public string $name;
    public string $password;  //Coloquei public string e public int nestes atributos, mas depois temos de rever isto
    public string $email;
    public bool $isAdmin;

    public function __construct($id, $username, $name, $password, $email, $isAdmin = false) {
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
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
            $user = new User($row['Id'], $row['Username'], $row['Name'], $row['Password'], $row['Email'], $row['Is_Admin']);
            $users[] = $user;
        }
    
        return $users;
    }
    
    static function getUserWithPassword(PDO $db, string $email, string $password) : ?User {
      $stmt = $db->prepare('
          SELECT *
          FROM User 
          WHERE lower(Email) = ? AND Password = ?
      ');

      $stmt->execute(array(strtolower($email), $password));

      if ($user = $stmt->fetch()) {
          return new User(
              $user['Id'],
              $user['Username'],
              $user['Name'],
              $user['Password'],
              $user['Email'],
              $user['Is_Admin']
          );
      } else return null;
  }

}
?>
