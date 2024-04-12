<!DOCTYPE html>
<head>
    <title>Voyager</title>
    <meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <div id="title_slogan">
            <h1><a href="index.php">Voyager</a></h1>
            <h2><a href="index.php">Buy, Sell, Explore</a></h2>
        </div>
        <div id=search>
            <input type="search" name="search" placeholder="Explore Voyager...">
            
        </div>
        <div id="login_signup_image">
            <a href="register_page.php">Login</a>
            <a href="login_page.php">Sign Up</a>
            <img src="images/anonymous.png">
        </div>
    </header>
    <nav id="nav_categories">
        <input type="checkbox" id="hamburger"> 
        <label class="hamburger" for="hamburger"></label>
        <ul>
            <li><a href="index.php">Eletronics</a></li>
            <li><a href="index.php">Clothing</a></li>
            <li><a href="index.php">Books</a></li>
            <li><a href="index.php">Furniture</a></li>
            <li><a href="index.php">Toys</a></li>
        </ul>
    </nav>
    <section id=featured>
        <h1><a href="item.html">Featured Products</a></h1>
        <section id=featured_articles>
            <article>
                <h1><a href="item.html">Quisque a dapibus magna, non scelerisque</a></h1>
                <img src="images/default.jpg" alt="default">
                <footer>
                    <span class="price"><a href="product.hpp">19.99€</a></span>
                    <span class="condition"><a href="product.hpp">Very Good</a></span>
                </footer>
            </article>
            <article>
                <h1><a href="product.hpp">Product Placement</a></h1>
                <img src="images/default.jpg" alt="default">
                <footer>
                    <span class="price"><a href="product.hpp">19.99€</a></span>
                    <span class="condition"><a href="product.hpp">Very Good</a></span>
                </footer>
            </article>
            <article>
                <h1><a href="product.hpp">Product Placement</a></h1>
                <img src="images/default.jpg" alt="default">
                <footer>
                    <span class="price"><a href="product.hpp">19.99€</a></span>
                    <span class="condition"><a href="product.hpp">Very Good</a></span>
                </footer>
            </article>
        </section>
    </section>
    
    <section id=products>
        <article>
            <h1><a href="item.html">Quisque a dapibus magna, non scelerisque</a></h1>
            <img src="images/default.jpg" alt="default">
            <footer>
                <span class="price"><a href="product.hpp">19.99€</a></span>
                <span class="condition"><a href="product.hpp">Very Good</a></span>
            </footer>
        </article>
        <article>
            <h1><a href="product.hpp">Product Placement</a></h1>
            <img src="images/default.jpg" alt="default">
            <footer>
                <span class="price"><a href="product.hpp">19.99€</a></span>
                <span class="condition"><a href="product.hpp">Very Good</a></span>
            </footer>
        </article>
        <article>
            <h1><a href="product.hpp">Product Placement</a></h1>
            <img src="images/default.jpg" alt="default">
            <footer>
                <span class="price"><a href="product.hpp">19.99€</a></span>
                <span class="condition"><a href="product.hpp">Very Good</a></span>
            </footer>
        </article>
    </section>
</body>