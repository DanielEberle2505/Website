<?php

namespace App\Wiki;

use App\Core\AbstractController;
use PDO;

//Klasse zum Kontrollieren der "Wiki" (verwalten)
class WikiController extends AbstractController {

    public function __construct(WikiRepository $wikiRepository) {
        //das Dazugehörige Repository, die die Datensätze aus der Datenbank verwaltet
        $this->wikiRepository = $wikiRepository;
    }


    //Funktion um alle Entries anzuzeigen
    public function showEntries() {
        $wikiEntries = $this->wikiRepository->all();

        $this->render("wiki/wiki", [
            'wikiEntries' => $wikiEntries
        ]);
    }

    /**
     * Funktion, die, über die URL übergebene id ein bestimmten "Entry" holt und dann die view showEntry.php rendert
     */
    public function showEntry() {

        $id = $_GET['id'];
        $wikiEntry = $this->wikiRepository->find($id);

        $this->render("wiki/showEntry", [
            'wikiEntry' => $wikiEntry
        ]);
    }

    /**
    * Funktion um eine Neue Entry hinzuzufügen holt sich Userinput von addEntry.php
    * und fügt dann den userinput als Wiki eintrag in die Datenbank ein
    */
    public function add() {

        if(isset($_POST['uploadButton'])) {
            $title=$_POST['title'];
            $content=$_POST['content'];
            if(isset($title)&&isset($content)) {
            $this->wikiRepository->addEntry($title,$content);
            header('location:/Website/public/index.php/wiki');
          }
        }
        $this->render("wiki/addEntry","");
    }

    /**
      *Funktion um Entries zu bearbeiten,holt sich sich Userinput von editEntry.php
      * und überarbeitet dann den dazugehörigen Wikieintrag
      *
    */
    public function edit() {
        if (isset($_POST['updateButton']) && isset($_POST['title']) && isset($_POST['content']) ) {

            //Variablen, die den Userinput zwischenspeichern
            $id = $_GET['id'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $this->wikiRepository->editEntry($id, $title, $content);
            $wikiEntries=$this->wikiRepository->all();
            return $this->render("wiki/wiki",['wikiEntries'=>$wikiEntries]);

        }
        $entry=$this->wikiRepository->find($_GET['id']);
        $this->render("wiki/editEntry",['entry'=>$entry]);
    }

    //Funktion um Entries zu löschen
    public function deleteEntry() {
      var_dump($_SERVER['PATH_INFO']);
      if ($_SERVER['PATH_INFO']=="/delete") {
        $id=$_GET['id'];
        $this->wikiRepository->delete($id);
        header('location:wiki');
      }
    }
}
