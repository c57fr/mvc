<?php
namespace OpenClassrooms\Blog\Model;

use \PDO;

class Manager
{
 protected function dbConnect()
 {
  return new PDO('mysql:host=localhost;dbname=tests;charset=utf8', 'root', '',[
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]);
 }
}
