<?php
// Chargement des classes
require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';

use \OpenClassrooms\Blog\Model\PostManager;  
use \OpenClassrooms\Blog\Model\CommentManager;  

function listPosts()
{
 $postManager = new PostManager();
 $posts       = $postManager->getPosts();

 require 'view/frontend/listPostsView.php';
}

function post($idp)
{
 $postManager    = new PostManager();
 $commentManager = new CommentManager();

 $post     = $postManager->getPost($idp);
 $comments = $commentManager->getComments($idp);

 require 'view/frontend/postView.php';
}

function addComment($postId, $author, $comment)
{
 $commentManager = new CommentManager();

 $affectedLines = $commentManager->postComment($postId, $author, $comment);

 if ($affectedLines === false) {
  throw new Exception('Impossible d\'ajouter le commentaire !');
 }
 header('Location: index.php?action=post&id=' . $postId);
}
