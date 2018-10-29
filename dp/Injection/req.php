<?php

class PDOFactory
{
 public static function getMysqlConnexion()
 {
  $dbc = new PDO('mysql:host=localhost;dbname=combats', 'root', '');
  $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  return $dbc;
 }

}

class SituPersonnages
{
 public function get($idn)
 {
  // On admet que MyPDO étend PDO et qu'il implémente un singleton.
  $dbd = new PDOFactory;
  $cnx = $dbd->getMysqlConnexion();

  $req = $cnx->prepare('select * from personnages_v2 where id=?');
  $req->execute([$idn]);

  return $req->fetch(PDO::FETCH_ASSOC);
 }
}

$req = new SituPersonnages;
$perso = $req->get(5);

echo "<pre>";
var_dump($perso);
echo "</pre>";
