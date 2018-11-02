<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    section {
      margin-bottom: 90px;
    }
    #htbs {
      background-color: rgba(0,0,0,.3);
      width: 100%;
      position: fixed;
      bottom:0;
      left:0;
      border-top:1px solid grey;
      margin-top: 100px;
      padding:10px;
    }
    #clickme {
      font-size: 2em;
      cursor: pointer;
    }
  </style>
</head>
<body>
<section>
<div id="haut"></div>
<?php

$magicien = new Magicien(['nom' => 'vyk12', 'type' => 'magicien']);

$classeMagicien = new ReflectionClass('Magicien'); // Le nom de la classe doit être entre apostrophes ou guillemets.

$objetMagicien = new ReflectionObject($magicien);

var_dump($classeMagicien, $objetMagicien);


if ($classeMagicien->hasProperty('magie')) {
  echo 'La classe Magicien possède un attribut $magie';
} else {
  echo 'La classe Magicien ne possède pas d\'attribut $magie';
}

echo '<br>';

if ($classeMagicien->hasMethod('lancerUnSort')) {
  echo 'La classe Magicien implémente une méthode lancerUnSort()';
} else {
  echo 'La classe Magicien n\'implémente pas de méthode lancerUnSort()';
}

echo '<br>';

$classePersonnage = new ReflectionClass('Personnage');

echo '<pre>', print_r($classePersonnage->getConstants(), true), '</pre>';


if ($classePersonnage->hasConstant('PERSO_ENDORMI')) {
  echo 'La classe Personnage possède une constante NOUVEAU (celle ci vaut ', $classePersonnage->getConstant('PERSO_ENDORMI'), ')';
} else {
  echo 'La classe Personnage ne possède pas de constante NOUVEAU';
}

echo '<hr>';

if ($parent = $classeMagicien->getParentClass()) {
  echo 'La classe Magicien a un parent : il s\'agit de la classe ', $parent->getName();
} else {
  echo 'La classe Magicien n\'a pas de parent';
}

echo '<br>';

if ($classeMagicien->isSubclassOf('Personnage')) {
  echo 'La classe Magicien a pour parent la classe Personnage';
} else {
  echo 'La classe Magicien n\'a la classe Personnage pour parent';
}

echo '<hr>';

$classePersonnage = new ReflectionClass('Personnage');

// Est-elle abstraite ?
if ($classePersonnage->isAbstract()) {
  echo 'La classe Personnage est abstraite';
} else {
  echo 'La classe Personnage n\'est pas abstraite';
}

echo '<br>';

// Est-elle finale ?
if ($classePersonnage->isFinal()) {
  echo 'La classe Personnage est finale';
} else {
  echo 'La classe Personnage n\'est pas finale';
}

echo '<br>';

if ($classePersonnage->isInstantiable()) {
  echo 'La classe Personnage est instanciable';
} else {
  echo 'La classe personnage n\'est pas instanciable';
}

echo '<hr>';

//class iMagicien{};
interface IMagicien
{
}

$classeIMagicien = new ReflectionClass('IMagicien');

if ($classeIMagicien->isInterface()) {
  echo 'La classe IMagicien est une interface';
} else {
  echo 'La classe IMagicien n\'est pas une interface';
}

echo '<br>';

if ($classeMagicien->implementsInterface('iMagicien')) {
  echo 'La classe Magicien implémente l\'interface iMagicien';
} else {
  echo 'La classe Magicien n\'implémente pas l\'interface iMagicien';
}

// ✨ReflectionClass::getInterfaces()etReflectionClass::getInterfaceNames()

echo '<br>';
$attributMagie1 = new ReflectionProperty('Magicien', 'magie');
$attributMagie2 = $classeMagicien->getProperty('magie');

echo 'Attribut: ', $attributMagie1, ' = ', $attributMagie2;

$attributsPersonnage = $classePersonnage->getProperties();
echo '<pre>';
print_r($attributsPersonnage);
echo '</pre><hr>';

foreach ($classeMagicien->getProperties() as $attribut) {
  $attribut->setAccessible(true);

  if ($attribut->isPublic()) {
    $visibilite = 'public';
  } elseif ($attribut->isProtected()) {
    $visibilite = 'protected';
  } else {
    $visibilite = 'public';
  }

  // Attribut de la classe et non de l'objet
  $isStatic = ($attribut->isStatic()) ? ' (attribut statique)' : '';

  echo $attribut->getName(), ' => (', $visibilite, $isStatic, ') <strong>', $attribut->getValue($magicien), '</strong><br>';

  $attribut->setAccessible(false);
}

Personnage::$face = "Barbe longue";
echo Personnage::$face, '<br>';


/**
 *  Test class
 */
class A
{
  public static $attr1 = 'Bonjour le monde !';
  public static $attr2 = 'Bonjour le monde !';

/**
 * Hello function
 *
 * @param [mixed] $arg1
 * @param [mixed] $arg2
 * @param integer $arg3
 * @param string $arg4
 * @return string
 */
  public function hello($arg1, $arg2, $arg3 = 1, $arg4 = 'Hello world !')
  {
    echo 'Hello world !' . $arg1 . $arg2 . $arg3 . $arg4;
  }
}

$classeA = new ReflectionClass('A');
echo $classeA->getStaticPropertyValue('attr1'), ' '; // Affiche Hello world !

$classeA->setStaticPropertyValue('attr1', 'Hello world !');
echo $classeA->getStaticPropertyValue('attr1'); // Affiche Bonjour le monde !
echo "<br>";
foreach ($classeA->getStaticProperties() as $attr)
{
  echo $attr, ' ';
}
echo '<br>';

$methode1 = new ReflectionMethod('A', 'hello');
$methode2 = $classeA->getMethod('hello');
echo '<pre>';
print_r($methode1);
print_r($methode2);
echo '</pre>';

echo 'La méthode ', $methode1->getName(), '() est ';

if ($methode1->isPublic())
{
  echo 'publique';
}
elseif ($methode1->isProtected())
{
  echo 'protégée';
}
else
{
  echo 'privée';
}
if ($methode1->isStatic())
{
  echo ' (en plus elle est statique)';
}

echo '<br>';

$a = new A;

echo '<pre>';
print_r($methode1->invoke($a,'test', 'test'));
$methode1->invokeArgs($a, ['test', 'autre test']);
// Les deux arguments sont cette fois-ci contenus dans un tableau.
echo '</pre>';

// Si pb de visibilité: ReflectionMethod::setAccessible($bool)


echo ' (Méthode ';
if ($methode1->isAbstract())
{
  echo 'abstraite';
}
elseif ($methode1->isFinal())
{
  echo 'finale';
}
else
{
  echo '« normale »';
}
echo ')';

if ($methode1->isConstructor())
{
  echo 'La méthode ', $methode1->getName(), ' est le constructeur';
}
elseif ($methode1->isDestructor())
{
  echo 'La méthode ', $methode1->getName(), ' est le destructeur';
}
?>
<h2>Annotations</h>
<?php


?>
</section>
<div id='htbs'>
  <div id="bas"></div>
  <div id="clickme">⏫</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script langage="javascript">

$(function () {
  var flip=0;

  $('#haut').on("click", function () {
    $('html, body').animate({
        scrollTop: $('html, body').height()
    }, 2000);
    return false;
  });

  $('#bas').on("click", function () {
    $('html, body').animate({
        scrollTop: '0px'
    }, 2000);
    return false;
  });

  $('#haut').click();

  $( "#clickme" ).click(function() {
    console.log('flip = ' + flip);

    $( "section" ).toggle( "slow", function() {
      $( "section" ).show();

      if (flip++% 2) {
        // flip pair
        $('#clickme').html('⏫');
        $('#haut').click();
      }
      else {
        // flip impair
        $('#clickme').html('⏬');
        $('#bas').click();
      }
      return false;
    });
  });

});

</script>

</body>
</html>
