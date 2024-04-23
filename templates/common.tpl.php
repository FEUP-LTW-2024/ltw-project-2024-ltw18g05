

<!-- Header HTML code-->
<?php function drawHeader() { ?>
<header>
    <div id="title_slogan">
        <h1><a href="index.php">Voyager</a></h1>
        <h2><a href="index.php">Buy, Sell, Explore</a></h2>
    </div>
    <div id=search>
        <input type="search" name="search" placeholder="Explore Voyager...">
        <button formaction="login.php" formmethod="post" type="submit">Search</button>
    </div>
    <div id="login_signup_image">
        <a href="login.php">Login</a>
        <a href="register.php">Sign Up</a>
        <img src="/images/anonymous.png">
    </div>
</header>
<?php } ?>


<!-- Nav bar HTML code-->
<?php function drawNav() { ?>
<nav id="nav_categories">
        <ul>
            <li><a href="results.php">Eletronics</a></li>
            <li><a href="results.php">Clothing</a></li>
            <li><a href="results.php">Books</a></li>
            <li><a href="results.php">Furniture</a></li>
            <li><a href="results.php">Toys</a></li>
        </ul>
</nav>
<?php } ?>


<!-- Footer HTML code-->
<?php function drawFooter() { ?>
<footer>
    <p>&copy; Voyager International Commerce Group 2024</p>
</footer>
<?php } ?>


