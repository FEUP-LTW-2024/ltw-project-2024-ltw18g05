<?php 
  declare(strict_types = 1); 
  require_once(__DIR__ . '/../database/conversation.class.php');
  require_once(__DIR__ . '/../database/message.class.php');
  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/item.class.php');
?>

<!-- Header HTML code-->
<?php function drawHeader($session, $user) { ?>
<header>
    <div id="title_slogan">
        <h1><a href="index.php">Voyager</a></h1>
        <h2><a href="index.php">Buy, Sell, Explore</a></h2>
    </div>
    <form id=search action="results.php" method="get">
        <input type="search" id="search" name="search_content" placeholder="Explore Voyager...">
        <button id=big_button type="submit" value="Send">Search</button>
        <button id=small_button type="submit" value="Send">&#x1F50D;</button>
    </form>
    <?php if (!$session->isLoggedIn()): ?>
        <div id="login_signup_image">
            <a href="login.php">Login</a>
            <a href="register.php">Sign Up</a>
            <img src="/images/anonymous.png" alt="anonymous">
        </div>
    <?php else: 
         $unopenedMessagesCount = Message::getUnopenedMessagesCount($session->getId());
         ?>
        <div id="logout_profile">
        <a href="messages.php" id="messages">Messages<?= $unopenedMessagesCount > 0 ? '<span class="notification-badge">' . $unopenedMessagesCount . '</span>' : '' ?></a>
            <a href="wishlist.php" id="wishlist">Wishlist</a>
            <a href="../actions/logout.action.php">Logout</a>
            <a href="/pages/profile.php" > <img src="/images/profilepictures/<?= $user->profilepicture ?>.png" alt="anonymous"></a>
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


