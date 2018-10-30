<?php

require './Observed.php';
require './Observer.php';

$o = new Observed;

$observer1 = function (SplSubject $subject) {
 echo $this->name, ' a été notifié ! Nouvelle valeur de name : ', $subject->name(), "\n<br>";
};

$observer2 = function (SplSubject $subject) {
 echo $this->name, ' a été notifié ! Nouvelle valeur de name : ', $subject->name(), "\n<br>";
};

$o->attach(new Observer($observer1, 'Observer1'))
  ->attach(new Observer($observer2, 'Observer2'));

$o->setName('Victor');
// Ce qui affiche :
// Observer1 a été notifié ! Nouvelle valeur de name : Victor
// Observer2 a été notifié ! Nouvelle valeur de name : Victor
