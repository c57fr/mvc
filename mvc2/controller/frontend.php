<?php
// Chargement des classes
require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';

use \OpenClassrooms\Blog\Model\CommentManager;
use \OpenClassrooms\Blog\Model\PostManager;

function listPosts()
{
 $postManager = new PostManager();
 $posts       = $postManager->getPosts();

 require 'view/frontend/listPostsView.php';
}

function post($idp, $comment = null)
{
 $postManager    = new PostManager();
 $commentManager = new CommentManager();

 $post     = $postManager->getPost($idp);
 $comments = $commentManager->getComments($idp);

 require 'view/frontend/postView.php';
}

function comment($idc)
{
 $commentManager = new CommentManager();
 $comment        = $commentManager->getComment($idc);

 post($comment['idp'], $comment);

}

function addComment($postId, $author, $comment, $modif)
{
 $commentManager = new CommentManager();

 $affectedLines = $commentManager->postComment($postId, $author, $comment, $modif);

 $modif = ($modif) ? 'Modification' : 'Ajout';

 if ($affectedLines === false) {
  throw new Exception('Impossible d' . ($modif ? 'e modifier' : '\'ajouter') . ' le commentaire !');
 }
 header('Location: index.php?action=post&id=' . $postId . '&modif=' . $modif);
}
