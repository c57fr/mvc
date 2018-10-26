<?php

class PersonnagesManager
{
  private $dbc; // Instance de PDO

  public function __construct($dbc)
  {
    $this->dbc = $dbc;
  }

  public function add(Personnage $perso)
  {
    $qry = $this->dbc->prepare('INSERT INTO personnages_v2(nom, type) VALUES(:nom, :type)');

    $qry->bindValue(':nom', $perso->nom());
    $qry->bindValue(':type', $perso->type());

    $qry->execute();

    $perso->hydrate([
      'id' => $this->dbc->lastInsertId(),
      'degats' => 0,
      'atout' => 0
    ]);
  }

  public function count()
  {
    return $this->dbc->query('SELECT COUNT(*) FROM personnages_v2')->fetchColumn();
  }

  public function delete(Personnage $perso)
  {
    $this->dbc->exec('DELETE FROM personnages_v2 WHERE id = ' . $perso->idp());
  }

  public function exists($info)
  {
    if (is_int($info)) // On veut voir si tel personnage ayant pour id $info existe.
    {
      return (bool)$this->db->query('SELECT COUNT(*) FROM personnages_v2 WHERE id = ' . $info)->fetchColumn();
    }

    // Sinon, c'est qu'on veut vérifier que le nom existe ou pas.

    $qry = $this->dbc->prepare('SELECT COUNT(*) FROM personnages_v2 WHERE nom = :nom');
    $qry->execute([':nom' => $info]);

    return (bool)$qry->fetchColumn();
  }

  public function get($info)
  {
    if (is_int($info)) {
      $qry = $this->dbc->query('SELECT id idp, nom, degats, timeEndormi, type, atout FROM personnages_v2 WHERE id = ' . $info);
      $perso = $qry->fetch(PDO::FETCH_ASSOC);
    } else {
      $qry = $this->db->prepare('SELECT id idp, nom, degats, timeEndormi, type, atout FROM personnages_v2 WHERE nom = :nom');
      $qry->execute([':nom' => $info]);

      $perso = $qry->fetch(PDO::FETCH_ASSOC);
    }

    switch ($perso['type']) {
      case 'guerrier':
        return new Guerrier($perso);
      case 'magicien':
        return new Magicien($perso);
      default:
        return null;
    }
  }

  public function getList($nom)
  {
    $persos = [];

    $qry = $this->db->prepare('SELECT id idp, nom, degats, timeEndormi, type, atout FROM personnages_v2 WHERE nom <> :nom ORDER BY nom');
    $qry->execute([':nom' => $nom]);

    while ($donnees = $qry->fetch(PDO::FETCH_ASSOC)) {
      //echo "<pre>";print_r($donnees);echo "</pre>";
      switch ($donnees['type']) {
        case 'guerrier':
          $persos[] = new Guerrier($donnees);
          break;
        case 'magicien':
          $persos[] = new Magicien($donnees);
          break;
      }
    }

    return $persos;
  }

  public function update(Personnage $perso)
  {
    $qry = $this->db->prepare('UPDATE personnages_v2 SET degats = :degats, timeEndormi = :timeEndormi, atout = :atout WHERE id = :id');

    $qry->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
    $qry->bindValue(':timeEndormi', $perso->timeEndormi(), PDO::PARAM_INT);
    $qry->bindValue(':atout', $perso->atout(), PDO::PARAM_INT);
    $qry->bindValue(':id', $perso->idp(), PDO::PARAM_INT);

    $qry->execute();
  }
}