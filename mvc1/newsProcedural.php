<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>

<h1>Les news du site </h1>

<?php

//On se connecte à MySQL
$mysqli = new mysqli("localhost", "root", "", "mvc1");
$mysqli->set_charset("utf8");

$req = $mysqli->query("SELECT id, auteur, titre, DATE_FORMAT(date, '%d/%m/%Y %H') AS date_formatee, contenu
FROM news
ORDER BY date DESC");

//var_dump($req); exit;

while ($data = $req->fetch_assoc()) {
 echo '
  <div class="news">
  <h2>' . $data['titre'] . '</h2>
  <p>News postée le ' . str_replace(' ', ' à ', $data['date_formatee']) . ' par ' . $data['auteur'] . '</p>
  <p>' . $data['contenu'] . '</p>
  </div>';
}
?>

</body>
</html>
