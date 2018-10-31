<?php
$title = 'Mon blog';
ob_start();?>

<h1>Mon super blog !</h1>
<p>Derniers billets du blog :</p>

<p style="text-align: center">Pour apprendre en co-créant:</p>
<p style="text-align: center; font-size:1.5em; font-weight: bold; font-family: 'Comic Sans MS', arial; padding: 10px; background-color: orange; border-radius: 7px"><a style=" text-decoration: none;" href="http://c57.fr" target="_blank"> c57.fr</a></p>

<!--
<hr>
<a href="./doc" target="_blank">Doc</a>
<p>Générée avec composer update, puis: vendor\bin\phpdoc.php.bat -d ./mvc2 -t ./mvc2/doc</p>
<hr>
-->

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
