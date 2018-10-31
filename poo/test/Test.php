<?php

class Test
{
 public $pub    = 1;
 protected $pro = 2;
 private $pri   = 3;

 public function pub()
 {
  $this->pri = 5;
 }
}

$o = new Test;

foreach ($o as $k => $v) {
 echo $k . ' : ' . $v;
}
