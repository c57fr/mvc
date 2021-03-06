<?php
namespace OpenClassrooms\Blog\Model;

require_once "model/Manager.php";

class PostManager extends Manager
{
 public function getPosts()
 {
  $dbc = $this->dbConnect();
  $req = $dbc->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

  return $req;
 }

 public function getPost($postId)
 {
  $dbc = $this->dbConnect();
  $req = $dbc->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
  $req->execute(array($postId));
  $post = $req->fetch();

  return $post;
 }
}
