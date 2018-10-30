<?php
class FileReader implements Iterator
{
 protected $file;

 protected $currentLine;
 protected $currentKey;

 public function __construct($file)
 {
  if (!$this->file = fopen($file, 'r')) {
   throw new RuntimeException('Impossible d\’ouvrir "' . $file . '"');
  }
 }

 // Revient à la première ligne
 public function rewind()
 {
  fseek($this->file, 0);
  $this->currentLine = fgets($this->file);
  $this->currentKey  = 0;
 }

 // Vérifie que la ligne actuelle existe bien
 public function valid()
 {
  return $this->currentLine !== false;
 }

 // Retourne la ligne actuelle
 public function current()
 {
  return $this->currentLine;
 }

 // Retourne la clé actuelle
 public function key()
 {
  return $this->currentKey;
 }

 // Déplace le curseur sur la ligne suivante
 public function next()
 {
  if ($this->currentLine !== false) {
   $this->currentLine = fgets($this->file);
   $this->currentKey++;
  }
 }
}

$curseur = new FileReader('MonFichier.txt');

echo $curseur->rewind();
echo $curseur->next();
echo $curseur->next();
echo $curseur->current();
