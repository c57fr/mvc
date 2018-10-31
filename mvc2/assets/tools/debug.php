<style>
span#debug{
  font-size:1.5em; font-weight:bold;
}
</style>
<p>URI: <span id="debug"><?=$_SERVER["REQUEST_URI"]?></span></p>
<pre>
<?php
$params = ['GET', 'POST'];
foreach ($params as $param) {
 $param = '_' . $param;

 if (!empty($$param)) {
  array_unshift($$param, $param);
  print_r($$param);
 }
}
?>
</pre>