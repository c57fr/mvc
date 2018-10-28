<?php

$monObjet = new class

{
 public function sayHello($nom)
 {
  $this->nom = $nom;
  echo 'Hello ' . $nom . ' !<br>';
 }
};

$monObjet->sayHello('Lio');
echo $monObjet->nom . '<hr>';
$do = clone ($monObjet);
$do->sayHello('Do');
echo $monObjet->nom . '<hr>';
echo "<pre>";
print_r($monObjet);
print_r($do);
echo "</pre>";
