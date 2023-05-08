<?php

namespace App\Game;

use App\Core\AbstractRepository;

//Klasse, die sich um die Datenbankabfragen der "Games"-Einträge kümmert
class GamesRepository extends AbstractRepository {
    /**
     * Getter für den Tabellennamen
     */
    public function getTableName() {

        return "games";
    }

    /**
     * Getter für den Modelnamen
     */
    public function getModelName() {

        return "App\\Game\\GameModel";
    }

    /**
     *Funktion, die, die Datenbankabfrage enthält, die sich um das einfügen eines "Games" kümmert,
     *  benötigt den Namen, ein Bild und eine Beschreibung (werden alle als Strings übergeben)
     */
    public function addGame($name, $image, $description, $price) {

        $table = $this->getTableName();
        $stmt = $this->pdo->prepare("INSERT INTO `$table` (name, image, description, price) VALUES (:name, :image, :description, :price)");
        $stmt->execute(['name' => $name, 'image' => $image, 'description' => $description, 'price' => $price]);
    }

    /**
     *Funktion, die sich um die Datenbankabfrage zum editieren eines "Games" kümmert
     * benötigt den Namen, ein Bild und eine Beschreibung (werden alle als Strings übergeben)
     */
    public function editGame($id, $newName, $newImage, $newDescription, $newPrice) {
        $table = $this->getTableName();

        $stmt = $this->pdo->prepare("UPDATE `$table` SET name=:name, image=:image, description=:description, price=:price WHERE id=:id");

        $stmt->execute(['name' => $newName, 'image' => $newImage, 'description' => $newDescription, 'price' => $newPrice, 'id' => $id]);
    }
    public function editVisited($id,$visited) {
      $table = $this->getTableName();

      $stmt = $this->pdo->prepare("UPDATE `$table` SET  visited=:visited WHERE id=:id");

      $stmt->execute(['visited' => $visited, 'id' => $id]);

    }

}
