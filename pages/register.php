<?php
    require_once(__DIR__ . '/../templates/common.tpl.php');
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
        <form action="authenticate.php" method="post">
            <h2>Sign up today!</h2>
            <div class="input-container">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="input-container">
                <label for="username">Username:</label>
                <input type="username" id="username" name="username" required>
            </div>
            <div class="input-container">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-container">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/png,image/jpeg">
            </div>
            <button type="submit">Create Account</button>
    </div>

    <?php drawFooter();?>

</body>
</html>
