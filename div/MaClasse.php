<?php
class MaClasse
{
 public $attribut1;
 public $attribut2;
}

$a = new MaClasse;

$b = $a; // On assigne à $b l'identifiant de $a, donc $a et $b représentent le même objet.

$a->attribut1 = 'Hello';
echo $b->attribut1; // Affiche Hello.

$b->attribut2 = ' Salut';
echo $a->attribut2; // Affiche Salut.

echo "<hr>Avec __clone():<br>";

class MaClasse2
{
 private static $instances = 0;

 public function __construct()
 {
  self::$instances++;
 }

 public function __clone()
 {
  self::$instances++;
 }

 public static function getInstances()
 {
  return self::$instances;
 }
}

$a = new MaClasse2;
$b = clone $a;

echo 'Nombre d\'instances de MaClasse : ', MaClasse2::getInstances() . '<hr>';

class A
{
 public $attribut1;
 public $attribut2;
}

class B
{
 public $attribut1;
 public $attribut2;
}

$a            = new A;
$a->attribut1 = 'Hello';
$a->attribut2 = 'Salut';

$b            = new B;
$b->attribut1 = 'Hello';
$b->attribut2 = 'Salut';

$c            = new A;
$c->attribut1 = 'Hello';
$c->attribut2 = 'Salut';

if ($a == $b) {
 echo '$a == $b';
} else {
 echo '$a != $b';
}

echo '<br />';

if ($a == $c) {
 echo '$a == $c';
} else {
 echo '$a != $c';
}
