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
        <form action="authenticate.php" method="post">
            <h2>Login to Your Account</h2>
            <div class="input-container">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-container">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p class="no-account">Don't have an account? <a href="register.php">Sign up here</a>.</p>
    </div>

    <footer>
        <p>&copy; Voyager International Commerce Group</p>
    </footer>
</body>
</html>
