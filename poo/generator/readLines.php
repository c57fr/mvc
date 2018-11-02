<?php
function readLines($fileName)
{
 // Si le fichier est inexistant, on ne continue pas
 if (!$file = fopen($fileName, 'r')) {
  return;
 }

 // Tant qu'il reste des lignes à parcourir
 while (($line = fgets($file)) !== false) {
  // On dit à PHP que cette ligne du fichier fait office de « prochaine entrée du tableau »
  yield $line;
 }

 fclose($file);
}

foreach (readLines('MonFichier.txt') as $line) {
 echo $line . '<br>';
}

echo '<hr>';

function generator()
{
 for ($i = 0; $i < 10; $i++) {
  yield 'Itération n°' . $i;
 }
}

foreach (generator() as $key => $val) {
 echo $key, ' => ', $val, '<br />';
}

echo '<hr>';

function generator2()
{
 // On retourne ici des chaines de caractères assignées à des clés
 yield 'a' => 'Itération 1';
 yield 'b' => 'Itération 2';
 yield 'c' => 'Itération 3';
 yield 'd' => 'Itération 4';
}

foreach (generator2() as $key => $val) {
 echo $key, ' => ', $val, '<br />';
}

echo '<hr>';

class SomeClass
{
 protected $attr;

 public function __construct()
 {
  $this->attr = ['Un', 'Deux', 'Trois', 'Quatre'];
 }

 public function generator()
 {
  foreach ($this->attr as $val) {
   yield $val;
  }
 }
}

foreach ((new someClass)->generator() as $val) {
 echo $val . '<br>';
}

echo "<hr>";

class SomeClass2
{
 protected $attr;

 public function __construct()
 {
  $this->attr = ['Un', 'Deux', 'Trois', 'Quatre'];
 }

 // Le & avant le nom du générateur indique que les valeurs retournées sont des références
 public function &generator()
 {
  // On cherche ici à obtenir les références des valeurs du tableau pour les retourner
  foreach ($this->attr as &$val) {
   yield $val;
  }
 }

 public function attr()
 {
  return $this->attr;
 }
}

$obj = new SomeClass2;

// On parcourt notre générateur en récupérant les entrées par référence
foreach ($obj->generator() as &$val) {
 // On effectue une opération quelconque sur notre valeur
 $val = strrev($val);
}

echo '<pre>';
var_dump($obj->attr());
echo '</pre>';

echo "<hr>";

function generator3()
{
  echo yield;
}

$gen = generator3();
$gen->send('Hello world !');

echo "<hr>";

function generator4()
{
  echo (yield 'Hello world !');
  echo yield;
}

$gen = generator4();

 // On envoie « Message 1 »
// PHP va donc l'afficher grâce au premier echo du générateur
$gen->send('Message 1<br>');

// On envoie « Message 2 »
// PHP reprend l'exécution du générateur et affiche le message grâce au 2ème echo
$gen->send('Message 2');

// On envoie « Message 3 »
// La fonction générateur s’était déjà terminée, donc rien ne se passe
$gen->send('Message 3');