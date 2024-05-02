

<!-- Header HTML code-->
<?php function drawHeader() { ?>
<header>
    <div id="title_slogan">
        <h1><a href="index.php">Voyager</a></h1>
        <h2><a href="index.php">Buy, Sell, Explore</a></h2>
    </div>
    <form id=search action="results.php" method="get">
        <input type="search" id="search" name="search_content" placeholder="Explore Voyager...">
        <button type="submit" value="Send">Search</button>
    </form>
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
            <li><a href="results.php?search_content=Eletronics">Eletronics</a></li>
            <li><a href="results.php?search_content=Clothing">Clothing</a></li>
            <li><a href="results.php?search_content=Books">Books</a></li>
            <li><a href="results.php?search_content=Furniture">Furniture</a></li>
            <li><a href="results.php?search_content=Toys">Toys</a></li>
        </ul>
</nav>
<?php } ?>


<!-- Footer HTML code-->
<?php function drawFooter() { ?>
<footer>
    <p>&copy; Voyager International Commerce Group 2024</p>
</footer>
<?php } ?>


