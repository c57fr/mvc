<?php
// https://putaindecode.io/fr/articles/php/injection-dependances/

interface AddressInterface
{
 public function getFullAddress();
}

class Address implements AddressInterface
{
 private $number;
 private $street;
 private $zipcode;
 private $city;

 public function __construct($number, $street, $zipcode, $city, $country)
 {
  $this->number  = $number;
  $this->street  = $street;
  $this->zipcode = $zipcode;
  $this->city    = $city;
  $this->country = $country;
 }

 public function getFullAddress()
 {
  return $this->number . ', ' . $this->street . ', ' . $this->zipcode . ' ' . $this->city . ', ' . $this->country;
 }
}

class BasicAddress implements AddressInterface
{
 private $address;

 public function __construct($address)
 {
  $this->address = $address;
 }

 public function getFullAddress()
 {
  return $this->address;
 }
}

class PersonFactory
{
 public function createPerson($number, $street, $zipcode, $city, $country)
 {
  $address = new Address($number, $street, $zipcode, $city, $country);
  return new Person($address);
 }

 private function getZipcodeFromDistrict($district)
 {
  return 75000 + $district;
 }

 public function createParigot($number, $street, $district)
 {
  return $this->createPerson($number, $street, $this->getZipcodeFromDistrict($district), 'Paris', 'France');
 }
}

class Person
{
 private $address;

 public function __construct(AddressInterface $address)
 {
  $this->address = $address;
 }

 public function getAddress()
 {
  return $this->address;
 }
}

// Conteneur d'injection de dépendences
class DependencyInjectionContainer
{
    public function getPersonFactory()
    {
        return new PersonFactory();
    }
}

$address = new BasicAddress('test test un deux un deux');
$person  = new Person($address);

$factory = new PersonFactory();
$lio     = $factory->createPerson(12, 'allée des Roses', 59410, 'ANZIN', 'FR');

// $unParigot = new PersonFactory;
// $unParigot->createParigot(1, 'Rue République', 16);

echo ($person->getAddress()->getFullAddress()); // 'test test un deux un deux'
echo "<br>";
echo ($lio->getAddress()->getFullAddress()); // '1, rue de la Paix, 75002 Paris, France'

var_dump($person->getAddress(), $lio);
