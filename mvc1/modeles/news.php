<?php

function recuperer_news()
{
 global $mysqli;

 $req = $mysqli->query("SELECT id, auteur, titre, DATE_FORMAT(date, '%d/%m/%Y %H') AS date_formatee, contenu
FROM news
ORDER BY date DESC");

 $news = [];
 while ($data = $req->fetch_assoc()) {
  $news[] = $data;
 }
 return $news;
}
