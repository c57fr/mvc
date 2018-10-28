<?php
class HTMLFormater implements Formater
{
 public function format($text)
 {
  return '<p>Date : ' . date('d/m/Y',time()) . '<br />' . "\n" . 'Texte : ' . $text . '</p>';
 }
}
