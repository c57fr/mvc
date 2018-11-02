<?php

$f = function () {
 echo 'Hello world !<br>';
};

$f();
var_dump($f);

echo '<hr>';

// Notre fonction accepte 1 argument : le nombre actuellement traité par array_map
$traducteur = function ($nbr, $allemand, $anglais) {
 return $nbr . ' se dit ' . $allemand . ' et ' . $anglais;
};

$listeNbr     = range(1, 3);
$motsAllemand = ['ein', 'zwei', 'drei'];
$motsAnglais  = ['one', 'two', 'three'];

$traduction = array_map($traducteur, $listeNbr, $motsAllemand, $motsAnglais);

var_dump(
 $traduction,
 'En allemand'
);

echo '<hr>';

var_dump(
 array_map(
  function ($person) {return $person['name'] . ' (' . $person['position'] . ')';},
  [['id' => 1, 'name' => 'Bob', 'position' => 'Clerk'], ['id' => 2, 'name' => 'Alan', 'position' => 'Manager'], ['id' => 3, 'name' => 'James', 'position' => 'Director']])
);

echo '<hr>';

$quantite     = 5;
$additionneur = function ($nbr) use ($quantite) {
  return $nbr + $quantite;
};

$listeNbr = [1, 2, 3, 4, 5];
$listeNbr = array_map($additionneur, $listeNbr);

var_dump($listeNbr);
// On obtient là aussi le tableau [6, 7, 8, 9, 10]

$quantite = 40;

$listeNbr = array_map($additionneur, $listeNbr);
var_dump($listeNbr);
// On a : $listeNbr = [11, 12, 13, 14, 15] au lieu de [41, 42, 43, 44, 45]

echo '<hr>';

function creerAdditionneur($quantite)
{
  return function($nbr) use($quantite)
  {
    return $nbr + $quantite;
  };
}

$listeNbr = [1, 2, 3, 4, 5];

$listeNbr = array_map(creerAdditionneur(5), $listeNbr);
var_dump($listeNbr);
// On a : $listeNbr = [6, 7, 8, 9, 10]

$listeNbr = array_map(creerAdditionneur(4), $listeNbr);
var_dump($listeNbr);
// Cette fois-ci, on a bien : $listeNbr = [10, 11, 12, 13, 14]
