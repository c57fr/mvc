<?php
// Juste pour débugage
include 'assets/tools/debug.php';

require 'controller/frontend.php';

try {
 if (isset($_GET['action'])) {

  if ($_GET['action'] == 'listPosts') {

   listPosts(); // Affiche tous les posts (Comme qd action pas défini)

  } elseif ($_GET['action'] == 'post') {

   if (isset($_GET['id']) && $_GET['id'] > 0) {

    post($_GET['id']); // Affiche un post (Et ses commentaires)

   } else {
    throw new Exception('Aucun identifiant de billet envoyé');
   }
  } elseif ($_GET['action'] == 'comment') {

   if (isset($_GET['id']) && $_GET['id'] > 0) {
    comment($_GET['id']); // Affiche un commentaire (Pour update)
   } else {
    throw new Exception('Aucun identifiant de commentaire envoyé');
   }

  } elseif ($_GET['action'] == 'addComment') {
   if (isset($_GET['id']) && $_GET['id'] > 0) {
    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
     addComment($_GET['id'], $_POST['author'], $_POST['comment'], $_POST['modif']);
    } else {
     throw new Exception('Tous les champs ne sont pas remplis !');
    }
   } else {
    throw new Exception('Aucun identifiant de billet envoyé');
   }

  } elseif ($_GET['action'] == 'editComment') {
   if (isset($_GET['id']) && $_GET['id'] > 0) {
    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
     editComment($_GET['id'], $_POST['author'], $_POST['comment']);
    } else {
     throw new Exception('Tous les champs ne sont pas remplis !');
    }
   } else {
    throw new Exception('Aucun identifiant de billet envoyé');
   }
  }
 } else {
  listPosts();
 }
} catch (Exception $e) {
 echo 'Erreur : ' . $e->getMessage();
}
