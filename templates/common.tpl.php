<!-- Header HTML code-->
<?php function drawHeader($session) { ?>
<header>
    <div id="title_slogan">
        <h1><a href="index.php">Voyager</a></h1>
        <h2><a href="index.php">Buy, Sell, Explore</a></h2>
    </div>
    <div id="hidden_search">
        <input type="checkbox" id="search_caller"> 
        <label class="search_caller" for="search_caller"></label>
        <h2><a>Search here!</a></h2>
    </div>
    <form id=search action="results.php" method="get">
        <input type="search" id="search" name="search_content" placeholder="Explore Voyager...">
        <button type="submit" value="Send">Search</button>
    </form>
    <?php if (!$session->isLoggedIn()): ?>
        <div id="login_signup_image">
            <a href="login.php">Login</a>
            <a href="register.php">Sign Up</a>
            <img src="/images/anonymous.png" alt="anonymous">
        </div>
    <?php else: ?>
        <div id="logout_profile">
            <a href="../actions/logout.action.php">Logout</a>
            <a href="profile.php" id="name_of_user"><?= $session->getName() ?></a>
            <img src="/images/profilepictures/<?= $session->getProfilepicture() ?>.png" alt="anonymous">
        </div>
    <?php endif; ?>
</header>
<?php } ?>


<!-- Nav bar HTML code-->
<?php function drawNav(array $categories) { ?>
<nav id="nav_categories">
    <input type="checkbox" id="hamburger"> 
    <label class="hamburger" for="hamburger"></label>  
    <ul>
        <?php foreach ($categories as $category): ?>
            <li><a href="results.php?category_filter=<?= urlencode($category->name) ?>&search_content="><?= $category->name ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>
<?php } ?>



<!-- Footer HTML code-->
<?php function drawFooter() { ?>
<footer>
    <p>&copy; Voyager International Commerce Group 2024</p>
</footer>
<?php } ?>


