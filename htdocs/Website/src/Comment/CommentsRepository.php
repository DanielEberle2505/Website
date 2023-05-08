<?php

namespace App\Comment;

use App\Core\AbstractRepository;
use PDO;

//Klasse, die, die Datenbank abfragen beinhaltet
class CommentsRepository extends AbstractRepository {
    /**
     * Getter für den Tabellenamen
     */
    public function getTableName() {
        return "comment";
    }

    /**
     * Getter für den Modelnamen
     */
    public function getModelName() {
        return "App\\Comment\\CommentModel";
    }

    /**
     *Funktion die, die Datenbankabrfage enthält, die sich um das einfügen eines "Comments" kümmert.
     * benötigt den Content und die Gameid des Eintrages (beides als String übergeben)
     */
    public function addComment($comment, $gameid, $stars) {
        $table = $this->getTableName();
        $model = $this->getModelName();
        $stmt = $this->pdo->prepare("INSERT INTO `$table` (`comment`,`gameid`, `stars`) VALUES (:comment,:gameid,:stars)");
        $stmt->execute(['comment' => $comment, 'gameid' => $gameid, 'stars'=> $stars]);
    }

    /**
     * Funktion, die, die Datenbankabfrage enthält, die einen Bestimmten "Commenteintrag" anhand seines Namens finden soll
     * benötigt den Namen (als String übergeben)
     */
    public function editEntry($id,$comment,$gameid, $stars) {
        $table = $this->getTableName();
        $stmt = $this->pdo->prepare("UPDATE `$table` set comment=:comment, stars=:stars where id=:id && gameid=:gameid");
        $stmt->execute(['comment'=>$comment, 'gameid' => $gameid, 'id'=>$id, 'stars'=>$stars]);
    }

    /*Funktion, die alle Kommentare anhand der Gameid anzeigt**/
    public function showAllEntriesById($gameid) {
      $table = $this->getTableName();
      $model = $this->getModelName();
      $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE gameid=:gameid");
      $stmt->execute(['gameid' => $gameid]);
      $object = $stmt->fetchAll(PDO::FETCH_CLASS, $model);
      return $object;
    }

}
