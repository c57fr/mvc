<?php

namespace OpenClassrooms\Blog\Model;

require_once "model/Manager.php";

class CommentManager extends Manager
{
 public function getComments($postId)
 {
  $dbc      = $this->dbConnect();
  $comments = $dbc->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
  $comments->execute(array($postId));

  $comments->nbr = $comments->rowCount();
  return $comments;
 }

 public function getComment($idc)
 {
  $dbc = $this->dbConnect();
  $req = $dbc->prepare('SELECT id, post_id as idp, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
  $req->execute(array($idc));

  $comment = $req->fetch();

  return $comment;
 }

 public function postComment($postId, $author, $comment, $modif)
 {
  $dbc = $this->dbConnect();

  if (!$modif) {
   $comments      = $dbc->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
   $affectedLines = $comments->execute(array($postId, $author, $comment));
   if ($affectedLines) {
    echo "<hr>Commentaire jouté<hr>";
   }
  } else {

   $comments      = $dbc->prepare('UPDATE comments SET post_id=?, author=?, comment=?, comment_date=NOW() WHERE id=?');

   $affectedLines = $comments->execute(array($postId, $author, $comment, $modif));
   
   if ($affectedLines) {
    echo "<hr>Commentaire modifié<hr>";
   }
  }

  return $affectedLines;
 }

 public function updateComment($postId, $author, $comment, $modif)
 {
  $dbc           = $this->dbConnect();
  $comments      = $dbc->prepare('UPDATE comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW()) WHERE id=?');
  $affectedLines = $comments->execute(array($postId, $author, $comment, $modif));

  return $affectedLines;
 }
}
