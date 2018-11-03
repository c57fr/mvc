<?php
require('./controller/frontend.php');
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['post_id']) && $_GET['post_id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } 
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['post_id']) && $_GET['post_id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['post_id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        // Add for this exercise
        elseif ($_GET['action'] == 'viewCommentToEdit') {
            if (isset($_GET['comment_id']) && $_GET['comment_id'] > 0) {
                viewCommentToEdit();
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        elseif ($_GET['action'] == 'modifyComment') {
            if ((isset($_GET['comment_id']) && $_GET['comment_id'] > 0) 
                &&(isset($_GET['post_id']) && $_GET['post_id'] > 0)) {
                if (!empty($_POST['comment'])) {
                    modifyComment($_GET['comment_id'], $_GET['post_id'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet et de commentaire envoyé');
            }
        }
        // End of adding
    }
    else {
        listPosts();
    }
}
catch (Exception $e) {
    echo 'Erreur : <br />' . $e->getMessage();
}