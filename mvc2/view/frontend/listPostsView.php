
<!--
<hr>
<a href="./doc" target="_blank">Doc</a>
<p>Générée avec composer update, puis: vendor\bin\phpdoc.php.bat -d ./mvc2 -t ./mvc2/doc</p>
<hr>
-->

<?php
$title = 'Mon blog';
ob_start();?>

<p>Derniers billets du blog :</p>

<?php
while ($data = $posts->fetch()) {
    ?>
    <div class="news">
        <h3>
            <?=htmlspecialchars($data['title'])?><em>Le <?=$data['creation_date_fr']?></em>
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
