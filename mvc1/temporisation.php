<?php
ob_start(); /* On initialise le tampon. */

/* Trois façons d'ajouter du texte au buffer : */
echo 'Blablabla voici du texte qui sera mis dans dans le buffer';

?>
 Encore du texte qui sera mis dans le buffer!
<?php

print 'OMG, encore du texte à mettre dans le buffer ! Il va déborder !?';

$now = time();
$end = $now + 600;
setcookie('debut', $now, $end);

$contents = ob_get_contents(); // Que vaut $contents ??
ob_end_flush(); /* On vide le tampon et on retourne le contenu au client. */

echo '<hr>' . $contents;
