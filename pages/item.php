<?php require_once(__DIR__ . '/../templates/common.tpl.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Voyager</title>
        <meta charset="UTF-8">
        <link href="/css/item.css" rel="stylesheet">
    </head>
    <body>
        <?php drawHeader();?>
        <section id=item>
                <img src="/images/defaults/default.jpg" alt="imagem">
            <section id=description>
                <h1>
                    Avião low cost (segunda mão)
                </h1>
                <p>
                aviao em segunda mao, em bom estado, tem 2 riscos na asa direita mas de resto está como novo
                </p>
                <section id=preco>
                    15000 Euros
                    <button>Add to cart</button>
                </section>
            </section>
        </section>
        <?php drawFooter();?>
    </body>
</html>