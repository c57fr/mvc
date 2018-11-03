<?php
namespace Cb74\Blog\Model;

require_once 'Manager.php';

class PostManager extends Manager
{
 public function getPosts()
 {
  $db = $this->dbConnect();

  $req = $db->query('SELECT id, title, content, DATE_FORMAT(post_date, \'le %d/%m/%Y à %Hh%imin%ss\') AS post_date_fr FROM posts ORDER BY post_date DESC LIMIT 0,5');

  return $req;
 }

 public function getPost($postId)
 {
  $db = $this->dbConnect();

  $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS post_date_fr FROM posts WHERE id = ?');
  $req->execute(array($postId));
  $post = $req->fetch();

  return $post;
 }
}