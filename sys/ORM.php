<?php

class ORM {
  public $pdo;

  public function __construct() {
    $db = array (
      'hostname' => 'localhost',
	'database' => 'ketosin2020',
	'username' => 'root',
	'password' => ''
    );
    $this->pdo = new PDO("mysql:host=$db[hostname];dbname=$db[database]", $db['username'], $db['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  }

  public function Insert($data, $table) {
    $q = "INSERT INTO " . $table . " (" . implode(', ', array_keys($data)) . ") VALUES (:" . implode(', :', array_keys($data)) . ")";
    $this->Execute($q, $data);
  }

  public function Update($data, $where, $table) {
    $valz = "";
    $i = 0;

    foreach($data as $key => $val) {
      $valz .= " $key = :$key ";

      if(++$i < count($data))
        $valz .= ", ";
    }

    $q = "UPDATE " . $table . " SET $valz $where";
    $this->Execute($q, $data);
  }

  public function Delete($where, $table) {
    $q = "DELETE FROM " . $table . " $where";
    $this->Execute($q);
  }

  public function Select($columns, $params) {
    $q = "SELECT $columns FROM $params";

    $p = $this->pdo->prepare($q);
    $p->execute();

    $d = $p->fetchAll(PDO::FETCH_ASSOC);

    return $d;
  }

  public function Execute($q, $data = []) {
    $p = $this->pdo->prepare($q);
    $p->execute($data);
  }
}

$p = new ORM;