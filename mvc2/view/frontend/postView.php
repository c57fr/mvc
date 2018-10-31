<?php

$title = htmlspecialchars($post['title']);
ob_start();?>

<p><a href="./">Retour à la liste des billets</a></p>

<div class="news">
    <h3>
        <?=htmlspecialchars($post['title'])?>
        <em>le <?=$post['creation_date_fr']?></em>
    </h3>

    <p>
        <?=nl2br(htmlspecialchars($post['content']))?>
    </p>
</div>

<h2><?=(!$comment) ? 'Commentaire' . (($comments->nbr>1) ? 's' : '') : 'Modifier le commentaire préalablement choisi'?></h2>

<form action="index.php?action=addComment&amp;id=<?=$post['id']?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" value=<?=($comment['author'])?$comment['author']:''?>>
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"><?=($comment['comment'])?$comment['comment']:''?></textarea>
    </div>
    
    <?=($comment)?'<input id="modif" name="modif" type="hidden" value='.$comment['id'].'>':''?>

    <div>
        <input type="submit" />
    </div>
</form>

<?php
while ($comment = $comments->fetch()) {
 ?>
    <p><strong><?=htmlspecialchars($comment['author'])?></strong> le <?=$comment['comment_date_fr']?> (<a href="index.php?action=comment&amp;id=<?=$comment['id']?>">modifier</a>)</p>
    <p><?=nl2br(htmlspecialchars($comment['comment']))?></p>
<?php
}

$content = ob_get_clean();
require 'template.php';?>
