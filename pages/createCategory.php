<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(dirname(__DIR__).'/database/session.class.php');
    require_once(dirname(__DIR__).'/database/user.class.php');
    require_once(__DIR__ . '/../database/connection.db.php');


    $session = new Session();
    $db = getDatabaseConnection();
    if ($session->isLoggedIn()) {$user = User::getUserFromId($db,$session->getId());}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Voyager</title>
    <meta charset="UTF-8">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/createCategory.css" rel="stylesheet">
</head>
<body>
    <?php drawHeader($session, $user); ?>
    
    <div class="login-container">
        <form action="../actions/createCategory.action.php" method="post">
            <h2>Create a new Category</h2>
            <div class="input-container">
                <label for="Name">New Category:</label>
                <input type="text" id="cat" name="category" required>
            </div>
            <button type="submit">Create</button>
        </form>
    </div>

    <?php drawFooter();?>

</body>
</html>
