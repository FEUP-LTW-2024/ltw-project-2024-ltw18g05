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
    <title> Edit Profile - Voyager</title>
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
        <form action="../actions/editregister.action.php" method="post">
            <h2>Edit Profile</h2>
            <div class="input-container">
                <label for="email">Email:</label>
                <input type="email" id="email" maxlength="100" name="email">
            </div>
            <div class="input-container">
                <label for="username">Username:</label>
                <input type="text" id="username" maxlength="20" name="username">
            </div>
            <div class="input-container">
                <label for="name">Name:</label>
                <input type="text" id="name" maxlength="30" name="name">
            </div>
            <div class="input-container">
                <label for="password1">Password:</label>
                <input type="password" id="password1" name="password1">
            </div>
            <div class="input-container">
                <label for="password2">Confirm Password:</label>
                <input type="password" id="password2" name="password2">
            </div>
            <div class="input-container">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address">
            </div>
            <div class="input-container">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" maxlength="15" name="phone">
            </div>
            <div class="input-container">
                <label for="profilepicture">Profile Picture:</label>
                <select name="profilepicture">
                    <option value="white" selected>White</option>
                    <option value="blue">Blue</option>
                    <option value="red">Red</option>
                    <option value="orange">Orange</option>
                    <option value="green">Green</option>
                    <option value="black">Black</option>
                </select>
            </div>
            <button type="submit">Edit Account</button>
        </form>
    </div>

    <?php drawFooter();?>

</body>
</html>
