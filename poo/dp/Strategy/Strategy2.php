<?php

function autoload($class)
{
 if (file_exists($path = $class . '.php')) {
  require $path;
 }
}
spl_autoload_register('autoload');

// Les 3 classes Formater son anonymiséees
$textFormater = new class implements Formater
{
 public function format($text)
 {
  return 'Date : ' . time() . "\n" . 'Texte : ' . $text;
 }
};

$htmlFormater = new class implements Formater
{
 public function format($text)
 {
  return '<p>Date : ' . time() . '<br />' . "\n" . 'Texte : ' . $text . '</p>';
 }
};

$xmlFormater = new class implements Formater
{
 public function format($text)
 {
  return '<?xml version="1.0" encoding="ISO-8859-1"?>' . "\n" .
  '<message>' . "\n" .
  "\t" . '<date>' . time() . '</date>' . "\n" .
   "\t" . '<texte>' . $text . '</texte>' . "\n" .
   '</message>';
 }
};

$writer = new FileWriter($htmlFormater, 'file.html');
$writer->write('Hello world !');

echo 'Fichier crée.<pre>';

print_r($writer);
echo "</pre>";

// En résumé, les Formater sont des classes anonymes
