<?php

class FileReader
{
 protected $f;

 public function __construct($path)
 {
  $this->f = fopen($path, 'c+');
 }

 public function __debugInfo()
 {
  return ['f' => fstat($this->f)];
 }
}

$f = new FileReader('fichier.txt');
var_dump($f); // Affiche les informations retournées par fstat.
