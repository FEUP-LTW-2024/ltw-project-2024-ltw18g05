<?php
declare(strict_types = 1);
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(dirname(__DIR__).'/database/session.class.php');
    require_once(__DIR__ . '/../database/connection.db.php');

    $session = new Session();

    $db = getDatabaseConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Voyager</title>
    <meta charset="UTF-8">
    <link href="/css/register.css" rel="stylesheet">
</head>
<body>
    <header>
        <div id="title_slogan">
            <h1><a href="index.php">Voyager</a></h1>
            <h2><a href="index.php">Buy, Sell, Explore</a></h2>
        </div>
    </header>
    
    <div class="register-container">
        <form action="../actions/register.action.php" method="post">
            <h2>Sign up today!</h2>
            <div class="input-container">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-container">
                <label for="email">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-container">
                <label for="email">Password:</label>
                <input type="password" id="password1" name="password1" required>
            </div>
            <div class="input-container">
                <label for="email">Confirm Password:</label>
                <input type="password" id="password2" name="password2" required>
            </div>
            <div class="input-container">
                <label for="email">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" required>
            </div>
            <button type="submit">Create Account</button>
        </form>
    </div>

    <?php drawFooter();?>

</body>
</html>
