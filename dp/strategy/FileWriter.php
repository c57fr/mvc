<?php
class FileWriter extends Writer
{
 // Attribut stockant le chemin du fichier.
 protected $file;

 public function __construct(Formater $formater, $file)
 {
  parent::__construct($formater);
  $this->file = $file;
 }

 public function write($text)
 {
  $file = fopen($this->file, 'w');
  fwrite($file, $this->formater->format($text));
  fclose($file);
 }
}
