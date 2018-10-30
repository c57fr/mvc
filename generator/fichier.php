<?php
$lines = file('MonFichier.txt');

foreach ($lines as $line) {
 // Effectuer une opération sur $line
 echo $line . '<br>';
}
