<?php 
require_once(__DIR__ . '/../templates/common.tpl.php'); 
require_once(__DIR__ . '/../database/connection.db.php');
require_once(dirname(__DIR__).'/database/session.class.php');
require_once(__DIR__ . '/../database/item.class.php');
require_once(__DIR__ . '/../database/category.class.php');
require_once(__DIR__ . '/../templates/messages.tpl.php'); 

$db = getDatabaseConnection();
$session = new Session();

$user1Id = isset($_GET['user1Id']) ? intval($_GET['user1Id']) : null;
$user2Id = isset($_GET['user2Id']) ? intval($_GET['user2Id']) : null;
$itemId = isset($_GET['itemId']) ? intval($_GET['itemId']) : null;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/message.css" rel="stylesheet">
    </head>
    <body>

        <?php drawHeader($session);?>

        <section id=conversation>
            <?php drawConversation($user1Id, $user2Id, $itemId, $session);?>
        </section>

        <?php drawFooter();?>
        
    </body>
</html>
