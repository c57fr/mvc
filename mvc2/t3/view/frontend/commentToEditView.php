<!-- Add for this excercise -->
<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<?php
$commentToEdit = $comment->fetch();
?>
<p><a href="index.php?action=post&post_id=<?= $commentToEdit['post_id'] ?>">Retour au billet</a></p>

<h2>Commentaire à modifier</h2>

    <p>
        <strong><?= htmlspecialchars($commentToEdit['author']) ?></strong>
        le <?= $commentToEdit['comment_date_fr'] ?>
    </p>
    <form action="index.php?action=modifyComment&comment_id=<?= $commentToEdit['id'] ?>&post_id=<?= $commentToEdit['post_id'] ?>" method="post">
        <div>
            <label for="comment">Commentaire</label><br />
            <!-- <textarea id="comment" name="comment"><?= nl2br(htmlspecialchars($commentToEdit['comment'])) ?></textarea> -->
            <textarea id="comment" name="comment"><?= $commentToEdit['comment'] ?></textarea>
        </div>
        <div>
            <input type="submit" value="Modifier"/>
        </div>
    </form>
<?php
$comment->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
<!-- End of adding -->
