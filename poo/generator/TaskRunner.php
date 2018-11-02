<h1>Multitâches Runner</h1>

<?php

class TaskRunner
{
 protected $tasks;

 public function __construct()
 {
  // On initialise la liste des tâches
  $this->tasks = new SplQueue;
 }

 public function addTask(Generator $task)
 {
  // On ajoute la tâche à la fin de la liste
  $this->tasks->enqueue($task);
 }

 public function run()
 {
  // Tant qu’il y a toujours au moins une tâche à exécuter
  while (!$this->tasks->isEmpty()) {
   // On enlève la première tâche et on la récupère au passage
   $task = $this->tasks->dequeue();

   // On exécute la prochaine étape de la tâche
   $task->send('Hello world !');

   // Si la tâche n’est pas finie, on la replace en fin de liste
   if ($task->valid()) {
    $this->addTask($task);
   }
  }
 }
}

$taskRunner = new TaskRunner;

function task1()
{
 for ($i = 1; $i <= 2; $i++) {
  $data = yield;
  echo 'Tâche 1, itération ', $i, ', valeur envoyée : ', $data, '<br />';
 }
}

function task2()
{
 for ($i = 1; $i <= 6; $i++) {
  $data = yield;
  echo 'Tâche 2, itération ', $i, ', valeur envoyée : ', $data, '<br />';
 }
}

function task3()
{
 for ($i = 1; $i <= 4; $i++) {
  $data = yield;
  echo 'Tâche 3, itération ', $i, ', valeur envoyée : ', $data, '<br />';
 }
}

$taskRunner->addTask(task1());
$taskRunner->addTask(task2());
$taskRunner->addTask(task3());

$taskRunner->run();

echo "<hr>";

function generator()
{
 // On fait une boucle de 5 yield pour garder quelque chose de simple
 for ($i = 0; $i < 9; $i++) {
  // On indique qu’on vient de rentrer dans la ième itération
  echo "Début $i<br />";

  // On essaye « d’attraper » la valeur qu’on nous a donnée
  try
  {
   yield;
  } catch (Exception $e) {
   // Si une exception a été levée, on indique son numéro
   echo "<strong>Exception $i<br /></strong>";
  }

  // Enfin, on indique qu’on vient de finir la ième itération
  echo "Fin $i<br />";
 }
}

$gen = generator();

foreach ($gen as $i => $val) {
 // On décide de lancer une exception pour l’itération n°3
 if ($i % 3) {
  $gen->throw(new Exception('Petit test'));
 }
}