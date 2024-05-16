<?php 
require_once(__DIR__ . '/../templates/common.tpl.php'); 
require_once(__DIR__ . '/../database/connection.db.php');
require_once(dirname(__DIR__).'/database/session.class.php');
require_once(__DIR__ . '/../database/item.class.php');
require_once(__DIR__ . '/../database/category.class.php');
require_once(__DIR__ . '/../templates/messages.tpl.php'); 

$db = getDatabaseConnection();
$session = new Session();
$categories = Category::getAllCategories($db);

if ($session->isLoggedIn()) {$user = User::getUserFromId($db,$session->getId());}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/messages.css" rel="stylesheet">
    </head>
    <body>

        <?php drawHeader($session, $user);?>
        <?php drawNav($categories);?>

        <section id=conversations>
            <?php drawConversations($session->getId());?>
        </section>

        <?php drawFooter();?>
        
    </body>
</html>
