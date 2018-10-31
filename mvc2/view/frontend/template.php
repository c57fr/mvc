<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?=$title?></title>
        <link href="public/css/style.css" rel="stylesheet" />
        <link rel="shortcut icon" href="favicon.ico" type="image/png" >
        <link rel="stylesheet" href="assets/css/style.css">
            </head>

    <body>
        <div class="main">

            <?php
include 'view/frontend/header.php';
?>

            <h2><a href="./" id="titre">Mon super blog !</a></h2>

            <p class="success"><?=(isset($_GET['modif']) ? $_GET['modif'] . ' du commentaire OK' : '')?></p>
            <?=$content?>

        </div>
    </body>
</html>
