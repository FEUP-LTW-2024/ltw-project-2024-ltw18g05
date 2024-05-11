<?php
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(dirname(__DIR__).'/database/session.class.php');
    $session = new Session();
  
    $_SESSION['input']['username newUser'] = $_SESSION['input']['name newUser'] ?? "";
    $_SESSION['input']['email newUser'] = $_SESSION['input']['email newUser'] ?? "";
    $_SESSION['input']['password1 newUser'] = $_SESSION['input']['password1 newUser'] ?? "";
    $_SESSION['input']['password2 newUser'] = $_SESSION['input']['password2 newUser'] ?? "";
    $_SESSION['input']['profile_picture newUser'] = $_SESSION['input']['profile_picture newUser'] ?? "";
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
                <label>Email: <input type="email" name="email" required="required" value="<?=htmlentities($_SESSION['input']['email newUser'])?>"></label>
            </div>
            <div class="input-container">
                <label>Username: <input type="text" name = "name" required="required" value="<?=htmlentities($_SESSION['input']['username newUser'])?>"></label>
            </div>
            <div class="input-container">
                <label>Password: <input type="password" name="password1" required="required" value="<?=htmlentities($_SESSION['input']['password1 newUser'])?>"></label>
            </div>
            <div class="input-container">
                <label>Confirm Password: <input type="password" name="password2" required="required" value="<?=htmlentities($_SESSION['input']['password2 newUser'])?>"></label>
            </div>
            <div class="input-container">
                <label>Profile Picture: <input type="file" name="profile_picture" required="required" value="<?=htmlentities($_SESSION['input']['profile_picture newUser'])?>"></label>
            </div>
            <button type="submit">Create Account</button>
        </form>
    </div>

    <?php drawFooter();?>

</body>
</html>
