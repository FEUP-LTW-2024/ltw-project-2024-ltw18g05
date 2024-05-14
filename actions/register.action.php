<?php
declare(strict_types = 1);
require_once(dirname(__DIR__).'/database/session.class.php');
require_once(__DIR__ . '/../database/connection.db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password1"]) && isset($_POST["password2"])) {
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        $username = $_POST["username"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];
        if ($password1 !== $password2) {
            die("Passwords do not match");
        }

        $session = new Session();
        $db = getDatabaseConnection();

        // Use named placeholders in the SQL statement
        $stmt = $db->prepare("INSERT INTO User (Username, Password, Email) VALUES (:username, :password, :email)");
        
        // Bind values using named placeholders
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password1);
        
        $stmt->execute();
        $stmt->closeCursor();

        header("Location: /../pages/index.php");
        exit();
    } 
    else {
        die("All fields are required");
    }
} else {
    header("Location: /../pages/register.php");
    exit();
}
?>
