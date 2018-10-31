<header>
    <div style="text-align: center; font-family: 'Comic Sans MS', arial; padding: 10px; background-color: orange; border-radius: 7px">
        <h1 style="font-size:2em; font-weight: bold; line-height:1; margin:20px"><a style="text-decoration: none" href="http://c57.fr" target="_blank"> c57.fr</a></h1>
        <p>Pour apprendre en co-créant</p>
    </div>
    <p style="margin-top: 0; text-align:right; font-style: italic"><a style="text-decoration: none" href="https://github.com/c57fr/mvc" target="_blank">Dépôt GitHub</a></p>
</header>

<!--
<hr>
<a href="./doc" target="_blank">Doc</a>
<p>Générée avec composer update, puis: vendor\bin\phpdoc.php.bat -d ./mvc2 -t ./mvc2/doc</p>
<hr>
-->

<?php
$title = 'Mon blog';
ob_start();?>

<h2>Mon super blog !</h2>
<p>Derniers billets du blog :</p>


<?php
while ($data = $posts->fetch()) {
 ?>
    <div class="news">
        <h3>
            <?=htmlspecialchars($data['title'])?>
            <em>le <?=$data['creation_date_fr']?></em>
        </h3>

        <p>
            <?=nl2br(htmlspecialchars($data['content']))?>
            <br />
            <em><a href="index.php?action=post&amp;id=<?=$data['id']?>">Commentaires</a></em>
        </p>
    </div>
<?php
}
$posts->closeCursor();

$content = ob_get_clean();
require 'template.php';
