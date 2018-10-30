<?php

$req = $mysqli->query("SELECT id, auteur, titre, DATE_FORMAT(date, '%d/%m/%Y %H') AS date_formatee, contenu
FROM news
ORDER BY date DESC");