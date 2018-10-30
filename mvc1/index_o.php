<!-- Fron controller -->
<?php

//On démarre la session
session_start();

require 'modeles/db.php';

//On inclut le contrôleur s'il existe et s'il est spécifié
if (!empty($_GET['page']) && is_file('controleur s/' . $_GET['page'] . '.php')) {
 include 'controleurs/' . $_GET['page'] . '.php';
} else {
 $_GET['page'] = 'accueil';
 include 'controleurs/accueil.php';
}

require 'modeles/db_close.php';