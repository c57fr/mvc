<?php
class DBFactory
{
  public static function load($sgbdr)
  {
    $classe = 'SGBDR_' . $sgbdr;

    if (file_exists($chemin = $classe . '.class.php')) {
      include $chemin;
      return new $classe;
    } else {
      throw new RuntimeException('La classe <strong>' . $classe . '</strong> n\'a pu être trouvée !');
    }
  }
}

try {
  $mysql = DBFactory::load('MySQL');
  echo 'Ok';
} catch (RuntimeException $e) {
  echo $e->getMessage();
}

class PDOFactory
{
  public static function getMysqlConnexion()
  {
    $dbc = new PDO('mysql:host=localhost;dbname=tests', 'root', '');
    $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbc;
  }

  public static function getPgsqlConnexion()
  {
    $dbc = new PDO('pgsql:host=localhost;dbname=tests', 'root', '');
    $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbc;
  }
}


