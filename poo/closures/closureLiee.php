<?php
// À un objet

$additionneur = function () {
 $this->_nbr += 50;
};

class MaClasse
{
 private $_nbr = 0;

 public function nbr()
 {
  return $this->_nbr;
 }
}

class AutreClasse
{}

$obj = new MaClasse;

// On obtient une copie de notre closure qui sera liée à notre objet $obj
// Cette nouvelle closure sera appelée en tant que méthode de MaClasse
// On aurait tout aussi bien pu passer $obj en second argument
// $additionneur = $additionneur->bindTo($obj, 'MaClasse');
// $additionneur = $additionneur->bindTo($obj, $obj);
// $additionneur = $additionneur->bindTo($obj, 'AutreClasse'); // Err
$additionneur = $additionneur->bindTo($obj, 'MaClasse');
$additionneur();

echo $obj->nbr(); // Affiche bien 5

echo "<hr>";

class Nombre
{
 private $_nbr;

 public function __construct($nbr)
 {
  $this->_nbr = $nbr;
 }
}

$closure = function () {
 var_dump($this->_nbr + 5);
};

$two   = new Nombre(2);
$three = new Nombre(3);

$closure->call($two);
$closure->call($three);

echo "<hr>";

// À une classe

// Grâce à static, ne peut être liée qu'à une classe
$additionneur2 = static function () {
 self::$_nbr += 5;
};

class MaClasse2
{
 private static $_nbr = 0;

 public static function nbr()
 {
  return self::$_nbr;
 }
}

$additionneur = $additionneur2->bindTo(null, 'MaClasse2');
$additionneur();

echo MaClasse2::nbr(); // Affiche bien 5

echo "<hr>";

// Liaison dynamique

class MaClasse3
{
  private static $_nbr = 0;

  public static function getAdditionneur()
  {
    return function()
    {
      self::$_nbr += 5;
    };
  }

  public static function nbr()
  {
    return self::$_nbr;
  }
}

$additionneur = MaClasse3::getAdditionneur();
$additionneur();

echo MaClasse3::nbr(); // Affiche bien 5