<?php

class Observed implements SplSubject
{
 protected $name;
 protected $observers = [];

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

 public function notify()
 {
  foreach ($this->observers as $observer) {
   $observer->update($this);
  }
 }

 public function name()
 {
  return $this->name;
 }

 public function setName($name)
 {
  $this->name = $name;
  $this->notify();
 }
}
