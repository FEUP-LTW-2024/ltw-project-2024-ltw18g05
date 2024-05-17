<?php
declare(strict_types = 1);
require_once(dirname(__DIR__).'/database/session.class.php');
require_once(__DIR__ . '/../database/connection.db.php');
$session = new Session();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $userId = $session->getId();
        $email = ($_POST["email"] === '') ? null : filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        $username = ($_POST["username"] === '') ? null : $_POST["username"];
        $name = ($_POST["name"] === '') ? null : $_POST["name"];
        $password1 = ($_POST["password1"] === '') ? null : $_POST["password1"];
        $password2 = ($_POST["password2"] === '') ? null : $_POST["password2"];
        $profilepicture = ($_POST["profilepicture"] === '') ? null : $_POST["profilepicture"];
        $address = ($_POST["address"] === '') ? null : $_POST["address"];
        $phone = ($_POST["phone"] === '') ? null : $_POST["phone"];


        $session = new Session();
        $db = getDatabaseConnection();

        // Check if passwords match
        if ($password1 !== $password2 && $password1 !== null) {
            $session->addMessage('warning', 'Passwords don\'t match');
            die(header('Location: ../pages/edit_profile.php'));
        }

        // Prepare SQL statement to update user
        $sql = "UPDATE User SET";
        $params = [];

        if ($email !== null) {
            $sql .= " Email = :email,";
            $params[':email'] = $email;
        }

        if ($username !== null) {
            $sql .= " Username = :username,";
            $params[':username'] = $username;
        }

        if ($name !== null) {
            $sql .= " Name = :name,";
            $params[':name'] = $name;
        }

        if ($password1 !== null) {
            // Hash and update password only if it's not null
            $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
            $sql .= " Password = :password,";
            $params[':password'] = $hashedPassword;
        }

        if ($profilepicture !== null) {
            $sql .= " Profile_Picture = :profilepicture,";
            $params[':profilepicture'] = $profilepicture;
        }

        if ($address !== null) {
            $sql .= " Address = :address,";
            $params[':address'] = $address;
        }

        if ($phone !== null) {
            $sql .= " Phone = :phone,";
            $params[':phone'] = $phone;
        }

        // Remove the trailing comma and space from SQL statement
        $sql = rtrim($sql, ", ");
        $sql .= " WHERE Id = :userId";

        // Add userId to params array
        $params[':userId'] = $userId;

        // Prepare and execute the SQL statement
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $stmt->closeCursor();

        $session->addMessage('success', "User profile updated");
        header("Location: /../pages/profile.php");
        exit();
    } else {
    header("Location: /../pages/edit_register.php");
    exit();
}
?>
