<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts() {
    $postManager = new \Cb74\Blog\Model\PostManager();
    
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post() {
    $postManager = new \Cb74\Blog\Model\PostManager();
    $commentManager = new \Cb74\Blog\Model\CommentManager();
    
    $post = $postManager->getPost($_GET['post_id']);
    $comments = $commentManager->getComments($_GET['post_id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment) {
    $commentManager = new \Cb74\Blog\Model\CommentManager();
    
    $affectedLines = $commentManager->postComment($postId, $author, $comment);
    
    if ($affectedLines == false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&post_id=' . $postId);
    }
}

// Add for this excercise
function viewCommentToEdit() {
    $commentManager = new \Cb74\Blog\Model\CommentManager();
    
    $comment = $commentManager->getComment($_GET['comment_id']);

    require('view/frontend/commentToEditView.php');
}

function modifyComment($commentId, $postId, $comment) {
    $commentManager = new \Cb74\Blog\Model\CommentManager();
    
    $affectedLines = $commentManager->updateComment($commentId, $comment);
    
    if ($affectedLines == false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=post&post_id=' . $postId);
    }
}
// End of addiing