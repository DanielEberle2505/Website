<?php

namespace App\Wiki;

use App\Core\AbstractRepository;
use PDO;

//Klasse, die, die Datenbank abfragen beinhaltet
class WikiRepository extends AbstractRepository {
    /**
     * Getter für den Tabellenamen
     */
    public function getTableName() {
        return "Wiki";
    }

    /**
     * Getter für den Modelnamen
     */
    public function getModelName() {
        return "App\\Wiki\\WikiModel";
    }

    /**
     *Funktion die, die Datenbankabrfage enthält, die sich um das einfügen eines "Wikieintrages" kümmert.
     * benötigt einen Titel und den Content des Eintrages (beides als String übergeben)
     */
    public function addEntry($title, $content) {
        $table = $this->getTableName();
        $model = $this->getModelName();
        $stmt = $this->pdo->prepare("INSERT INTO `$table` (`title`,`content`) VALUES (:title,:content)");
        $stmt->execute(['title' => $title, 'content' => $content]);
    }

    /**
     * Funktion, die, die Datenbankabfrage enthält, die einen Bestimmten "Wikieintrag" anhand seines Namens finden soll
     * benötigt den Namen (als String übergeben)
     */
    public function findByName($name) {

        $table = $this->getTableName();
        $model = $this->getModelName();
        $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE name = :name");
        $stmt->execute(['name' => $name]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
        $object = $stmt->fetch(PDO::FETCH_CLASS);

        return $object;
    }
    /*Funktion, die einen Wiki Eintrag editiert**/
    public function editEntry($id,$title,$content) {
        $table = $this->getTableName();
        $stmt = $this->pdo->prepare("UPDATE `$table` set title=:title,content=:content where id=:id");
        $stmt->execute(['title'=>$title, 'content' => $content, 'id'=>$id]);
    }

}
