<?php

namespace App\Core;

use PDO;
//Klasse zum extrahieren von Informationen aus einer Datenbank
abstract class AbstractRepository {

    public $pdo;
    // Repository braucht eine Datenbankverbindung, um seine Funktion ausüben zu können
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    //siehe Repository von den einzelnen Klassen
    abstract public function getTableName();
    abstract public function getModelName();

    //Funktion, die alle Einträge in der angegebenen Datenbank mit der angegebenen Blaupause (Model) übergibt
    function all() {
        $table = $this->getTableName();
        $model = $this->getModelName();
        $stmt = $this->pdo->query("SELECT * FROM `$table`");
        $object = $stmt->fetchAll(PDO::FETCH_CLASS, $model);
        return $object;
    }

    //Funktion, die einen bestimmten Datensatz aus der Datenbank anhend seiner Id mit der angegebenen Blaupause übergibt
    function find($id) {
        $table = $this->getTableName();
        $model = $this->getModelName();
        $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
        $object = $stmt->fetch(PDO::FETCH_CLASS);

        return $object;
    }

    //Funktion, die einen bestimmten Datensatz anhand seiner Id löscht
    function delete($id) {
        $table = $this->getTableName();
        $model = $this->getModelName();
        $stmt = $this->pdo->prepare("DELETE FROM `$table` WHERE id= :id");
        $stmt->execute(['id' => $id]);
    }
}

?>
