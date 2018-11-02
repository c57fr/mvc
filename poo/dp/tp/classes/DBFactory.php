<?php
class DBFactory
{
 public static function getMysqlConnexionWithPDO()
 {
  $dbc = new PDO('mysql:host=localhost;dbname=combats', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
  $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  return $dbc;
 }

 public static function getMysqlConnexionWithMySQLi()
 {
  return new MySQLi('localhost', 'root', '', 'news');
 }
}
