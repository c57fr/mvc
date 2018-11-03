<?php
namespace Cb74\Blog\Model;

class Manager
{
 protected function dbConnect()
 {
  $db = new \PDO('mysql:host=localhost;dbname=tests;charset=utf8', 'root', '');
  return $db;
 }
}
