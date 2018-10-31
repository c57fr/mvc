<?php

namespace OpenClassrooms\Blog\Model;

class Manager
{
 protected function dbConnect()
 {
  return new \PDO('mysql:host=localhost;dbname=tests;charset=utf8', 'dbuser', '');
 }
}
