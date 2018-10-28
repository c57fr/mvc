<?php
class DBWriter extends Writer
{
 protected $dbc;

 public function __construct(Formater $formater, PDO $dbc)
 {
  parent::__construct($formater);
  $this->dbc = $dbc;
 }

 public function write($text)
 {
  $qry = $this->dbc->prepare('INSERT INTO lorem_ipsum SET text = :text');
  $qry->bindValue(':text', $this->formater->format($text));
  $qry->execute();
 }
}
