<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(dirname(__DIR__).'/database/session.class.php');
    require_once(dirname(__DIR__).'/database/user.class.php');
    require_once(__DIR__ . '/../database/connection.db.php');


    $session = new Session();
    $db = getDatabaseConnection();

    //$_SESSION['input']['email login'] = $_SESSION['input']['email login'] ?? "";
    //$_SESSION['input']['password login'] = $_SESSION['input']['password login'] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Voyager</title>
    <meta charset="UTF-8">
    <link href="/css/login.css" rel="stylesheet">
</head>
<body>
    <header>
        <div id="title_slogan">
            <h1><a href="index.php">Voyager</a></h1>
            <h2><a href="index.php">Buy, Sell, Explore</a></h2>
        </div>
    </header>
    
    <div class="login-container">
        <form action="../actions/login.action.php" method="post">
            <h2>Login to Your Account</h2>
            <div class="input-container">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="input-container">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p class="no-account">Don't have an account? <a href="register.php">Sign up here</a>.</p>
    </div>

    <?php drawFooter();?>

</body>
</html>
