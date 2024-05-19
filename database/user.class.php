<?php

class User {
    public int $id;
    public string $username;
    public string $name;
    public string $password;  //Coloquei public string e public int nestes atributos, mas depois temos de rever isto
    public string $email;
    public bool $isAdmin;
    public string $profilepicture;
    public string $address;
    public string $phone;

    public function __construct($id, $username, $name, $password, $email, $isAdmin = false, $profilepicture = 'white', $address, $phone) {
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
        $this->isAdmin = $isAdmin;
        $this->profilepicture = $profilepicture;
        $this->address = $address;
        $this->phone = $phone;
    }

    static function getAllUsers(PDO $db) : array {
        $stmt = $db->prepare('SELECT * FROM User');
        $stmt->execute();
    
        $users = array();
    
        while ($row = $stmt->fetch()) {
            // Create a User object for each row and add it to the users array
            $user = new User($row['Id'], $row['Username'], $row['Name'], $row['Password'], $row['Email'], $row['Is_Admin'], $row['Profile_Picture'], $row['Address'], $row['Phone']);
            $users[] = $user;
        }
    
        return $users;
    }

    static function getUserById(int $id) : ?User {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM User WHERE Id = ?');
        $stmt->execute(array($id));
    
        if ($user = $stmt->fetch()) {
            return new User(
                $user['Id'],
                $user['Username'],
                $user['Name'],
                $user['Password'],
                $user['Email'],
                $user['Is_Admin'],
                $user['Profile_Picture'],
                $user['Address'],
                $user['Phone']
            );
        } else return null;
    }
    
    static function getUserWithPassword(PDO $db, string $email, string $password) : ?User {
      $stmt = $db->prepare('
          SELECT *
          FROM User 
          WHERE lower(Email) = ?
      ');

      $stmt->execute(array(strtolower($email)));

      $user = $stmt->fetch();

      if ($user && password_verify($password, $user['Password'])) {
          return new User(
            $user['Id'],
            $user['Username'],
            $user['Name'],
            $user['Password'],
            $user['Email'],
            $user['Is_Admin'],
            $user['Profile_Picture'],
            $user['Address'],
            $user['Phone']
          );
      } else return null;
  }

    static function getUserFromId(PDO $db, int $id) : ?User {
        $stmt = $db->prepare('SELECT * FROM User WHERE Id = ?');
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return new User(
                $user['Id'],
                $user['Username'],
                $user['Name'],
                $user['Password'],
                $user['Email'],
                $user['Is_Admin'],
                $user['Profile_Picture'],
                $user['Address'],
                $user['Phone']
            );
        } else { return null;}
    }

}
?>
