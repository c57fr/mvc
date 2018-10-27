<?php

class ManagerObserver
{
 public function __construct()
 {
  $this->infos = new ReflectionClass($this);
  // $this->infos->getName();
 }
}

class ManagerUser
{
 public function attach(SplObserver $observer)
 {
  $this->observers[] = $observer;
  return $this;
 }

 public function detach(SplObserver $observer)
 {
  if (is_int($key = array_search($observer, $this->observers, true))) {
   unset($this->observers[$key]);
  }
 }

 public function notify($service = null)
 {
  foreach ($this->observers as $observer) {

   if (!$service || $observer->infos->name === $service) {
    echo "Observer: ";
    // echo "<pre>"; print_r($observer); echo "</pre>";
    $observer->update($this);
   }
  }
  return $this;
 }
}

class User extends ManagerUser implements SplSubject
{
 public $username, $name, $email;

 public function __construct($username)
 {
  $this->username = $username;
 }

 public function setNom($name)
 {
  $this->name = $name;
  $this->notify('SecurityService');
  // $this->notify('EmailNotificationService');
  // $this ->notify('EmailNotificationService')
  // ->notify('SMSNotificationService');
  // $this->notify();
 }

 public function setEmail($email)
 {
  $this->email = $email;
  // $this->notify('SecurityService');
  // $this->notify('EmailNotificationService');
  $this->notify('EmailNotificationService')
   ->notify('SMSNotificationService');
  // $this->notify();
 }
}

class SecurityService extends ManagerObserver implements SplObserver
{
 public function update(SplSubject $user)
 {
  echo '<h2>User ' . $user->username . ' a mis son nom à jour. (' . $this->infos->name . ')<hr></h2>';
 }
}

class EmailNotificationService extends ManagerObserver implements SplObserver
{
 public function update(SplSubject $user)
 {
  // Ici envoi réel du mail
  // ...
  echo '<h2>User ' . $user->username . ' a reçu un email de notification du changement. . (' . $this->infos->name . ')</h2><hr>';
 }
}

class SMSNotificationService extends ManagerObserver implements SplObserver
{
 public function update(SplSubject $user)
 {
  // Ici envoi réel du mail
  // ...
  echo '<h2>User ' . $user->username . ' a reçu un SMS de notification du changement. . (' . $this->infos->name . ')</h2><hr>';
 }
}

$u = new User('GrCOTE7');

$u->attach(new SecurityService)
 ->attach(new EmailNotificationService)
 ->attach(new SMSNotificationService);

$u->setNom('CÔTE');
$u->setEmail('GC7@Gmail.com');

echo "<pre>";
print_r($u);
echo "</pre>";
