<?php

namespace App\Game;

use App\Core\AbstractController;
use App\Comment\CommentsRepository;
//Klasse zum Kontrollieren der "Games" (verwalten)
class GamesController extends AbstractController {

    public function __construct(GamesRepository $gamesRepository, CommentsRepository $commentsRepository) {
        //das Dazugehörige Repository, die die Datensätze aus der Datenbank verwaltet
        $this->gamesRepository = $gamesRepository;
        $this->commentsRepository = $commentsRepository;

    }

    /**
     * Funktion, die alle "Games" aus der Datenbank holt, und dann die view index.php rendert
     */
    public function index() {
        $games = $this->gamesRepository->all();

        $this->render("game/index", [
            'games' => $games,

        ]);
    }

    /**
     * Funktion, die, über die URL übergebene id ein bestimmtes "Game" und deren "Comments" und Bewertung holt und dann die view show.php rendert
     */
    public function show() {


        if(isset($_POST['shop'])) {
            $id = $_GET['id'];
            session_start();
            $_SESSION['cart'][$id]=$id;

        }
        $id = $_GET['id'];

        $game = $this->gamesRepository->find($id);
        $comments = $this->commentsRepository->showAllEntriesById($id);

        $this->gamesRepository->editVisited($id,$game['visited']);
        if(isset($_POST['commentButton']) && !$_POST['comment']=="" && isset($_POST['rating'])) {
          $gameid=$_GET['id'];
          $comment=$_POST['comment'];
          $rating=$_POST['rating'];

          $this->commentsRepository->addComment($comment, $gameid, $rating);
          header ('location:game?id='.$gameid);
      }

        $this->render("game/show", [
            'game' => $game,
            'comments' =>$comments
        ]);
    }

    /**
     * Funktion, zum hinzufügen eines "Games", die sich alle "Games" holt und dann die addGame view rendert,
     *  falls der Input aus der view addGame gesetzt ist, wird noch einmal überprüft,
     *  ob ein "Game" anhand seines Namens schon existiert, wenn dies nicht der Fall ist,
     *  wird anhand des Userinputs ein neuer Eintrag für ein Game erstellt
     */
    public function add() {
        if (isset($_POST['uploadButton']) && isset($_POST['name']) && isset($_POST['description']) && file_get_contents($_FILES['file']['tmp_name']) && isset($_POST['price'])) {

            //Variablen zum zwischenspeichern des Userinputs von der view addGame
            $name = $_POST['name'];
            $image = file_get_contents($_FILES['file']['tmp_name']);
            $description = $_POST['description'];
            $price = $_POST['price'];
            $games = $this->gamesRepository->all();

            //foreach Schleife, die überprüft, ob ein "Game" mit identischem Namen schon existiert,
            // wenn dies der fall ist wird die Index Funktion ausgeführt
            foreach ($games as $game) {
                if ($game->name == $name) {
                    header('location:index');
                }
            }
            $this->gamesRepository->addGame($name, $image, $description, $price);
            header('location:index');
        }
        $games = $this->gamesRepository->all();
        $this->render("game/addGame", [
            'games' => $games
        ]);
    }

    /**
     * Funktion zum editieren von einem "Game", die sich ein "Game" durch die,
     *  über die URL übergebene Id holt, und dann die view edit rendert.
     *  Wenn durch die view edit ein Userinput festgestellt wird und dieser nicht leer ist,
     *  wird das "Game" editiert
     */

    public function edit() {
        if (isset($_POST['updateButton']) && isset($_POST['name']) && isset($_POST['description']) && file_get_contents($_FILES['file']['tmp_name'])&& isset($_POST['price'])) {

            //Variablen, die den Userinput zwischenspeichern
            $id = $_GET['id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $image = file_get_contents($_FILES['file']['tmp_name']);
            $description = $_POST['description'];
            $this->gamesRepository->editGame($id, $name, $image, $description, $price);
            $game= $this->gamesRepository->find($id);
            header('location:index');
        }
        $game = $this->gamesRepository->find($_GET['id']);
        $this->render("game/edit", [
            'game' => $game
        ]);

    }
/*
  *Funktion, die den Warenkorb rendert
**/
    public function showCart() {
        session_start();
        $products=$_SESSION['cart'];
        foreach ($products as $product) {
          $games[$product]=$this->gamesRepository->find($product);
        }
        if(isset($_POST['payButton'])) {
            header('location:/Website/public/index.php/payment');
        }

        if(isset($_POST['removeAll'])) {

            unset($_SESSION['cart']);
            header('location:/Website/public/index.php/index');
        }

        /*
        * for each Schleife, die Elemente aus dem Warenkorb, der in einer Session Variable gespeichert ist entfernt
        **/
        foreach ($games as $game) {
            if(isset($_POST["remove".$game->id])) {
                unset($_SESSION['cart'][$game->id]);
                header('location:/Website/public/index.php/cart');
            }

        }
        $user=$_SESSION['id'];
        $this->render("shop/cart",[
            'games' => $games,
            'user' => $user

        ]);
    }
/* Funktion, die die payment.php rendert**/
    public function payment() {

            $this->render("shop/payment","");

    }
/*Funktion,, die sich um das hinzhufügen eines Kommentars, mit der Bewertung kümmert**/
    public function rate() {
      /*abfrage, ob der Button zum absenden des Kommentars gedrückt wurde und ob der Textinput für den Kommentar nicht leer ist**/
      if(isset($_POST['commentButton']) && !$_POST['comment']== "") {
        /*prozess zum hinzufügen des Kommentars**/
        $gameid=$_GET['id'];
        $comment=$_POST['comment'];
        $comments = $this->commentsRepository->showAllEntriesById($id);
        $this->commentsRepository->addComment($comment, $gameid);
        $game= $this->gamesRepository->find($id);
        /*rendern von der show.php für das game, indem der Kommentar und die Bewertung hinzugefügt worden sind**/
      return render("game/show", [
          'game' => $game,
          'comments' =>$comments
      ]);
    }

}
/*Funktion, die sich um das Löschen eines Games kümmert**/
    public function deleteGame() {
      $id=$_GET['id'];
      $this->gamesRepository->delete($id);
      $games=$this->gamesRepository->all();
      return $this->render("game/index", [
          'games' => $games
      ]);
    }

    /*Funktion, die den Dashboard rendert**/
    public function dashboard() {
      $games=$this->gamesRepository->all();
      $this->render("dashboard/dashboard", [
          'games' => $games
      ]);

    }
}






