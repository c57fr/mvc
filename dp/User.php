<?php

class EncadrementUser {

  public function attach(SplObserver $observer)
  {
    $this->observers[] = $observer;
  }

  public function detach(SplObserver $observer)
  {
    if (is_int($key = array_search($observer, $this->observers, true))) {
      unset($this->observers[$key]);
    }
  }

  public function notify()
  {
    foreach ($this->observers as $observer) {
      $observer->update($this);
    }
  }

}

class User extends EncadrementUser implements SplSubject
{
  public $nom, $pseudo, $email;

  public function __construct($pseudo)
  {
    $this->pseudo = $pseudo;
  }

  
  public function setNom($nom)
  {
    $this->nom = $nom;
    $this->notify();
  }

}

class Securite implements SplObserver
{
  public function update(SplSubject $user)
  {
    echo 'User ' . $user->pseudo . ' a mis son nom à jour.<hr>';
  }
}

$u = new User('GrCOTE7');
$u->attach(new Securite);
$u->setNom('CÔTE');
echo "<pre>";
print_r($u);
echo "</pre>";