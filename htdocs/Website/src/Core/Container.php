<?php
namespace App\Core;

use App\Game\GamesController;
use App\Game\GamesRepository;
use App\User\UsersController;
use App\User\UsersRepository;
use App\Wiki\WikiRepository;
use App\Wiki\WikiController;
use App\Comment\CommentsRepository;

use PDO;
use PDOException;
use App\Shop\Shop;
//Klasse zum erstellen von den anderen Klassen
class Container {
    //Variable, die, die Blaupausen zum erstellen von den einzelnen Klassen beinhaltet
    public $receipts = [];
    //Variable, die, die Instanz zum erstellen der Klassen darstellt
    public $instances = [];


    public function __construct() {
        $this->receipts = [
            'pdo' => function () {                  //Blaupause zum erstellen der Datenbankverbindung
                try {
                    $pdo = new PDO(
                        'mysql:host=localhost;dbname=4-swoppen-me;charset=utf8',
                        '4-swoppen-me',
                        'H4oakYpNxnom3mXltkGB'
                    );
                } catch (PDOException $e) {
                    echo "Connection to database failed";
                    die();
                }
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                return $pdo;
            },
            'gamesController' => function () {      //Blaupause zum erstellen des GamesControllers
                return new GamesController(
                    $this->make('gamesRepository'),
                    $this->make('commentsRepository')
                );
            },
            'gamesRepository' => function () {      //Blaupause zum erstellen des GamesRepositorys
                return new GamesRepository(
                    $this->make("pdo")
                );
            },
            'usersController' => function () {      //Blaupause zum erstellen des UsersControllers
                return new UsersController(
                    $this->make('usersRepository')
                );
            },
            'usersRepository' => function () {      //Blaupause zum erstellen des UsersRepositorys
                return new UsersRepository(
                    $this->make("pdo")
                );
            },
            'shop' => function () {      //Blaupause zum erstellen des Shops
                return new Shop();
            },
            'wikiController' => function () {      //Blaupause zum erstellen des WikiControllers
                return new WikiController(
                $this->make('wikiRepository')
        );
    },
            'wikiRepository' => function () {      //Blaupause zum erstellen des WikiRepositorys
                return new WikiRepository(
                $this->make("pdo")
        );
    },
            'commentsRepository' => function () {      //Blaupause zum erstellen des CommentsRepositorys
                return new CommentsRepository(
                $this->make("pdo")
        );
    },
        ];
    }

    //Funktion zum erstellen von den Elementen anhand ihrer Blaupausen. Der identifier ist hier der Name
    public function make($name) {
        if (!empty($this->instances[$name])) {
            return $this->instances[$name];
        }

        if (isset($this->receipts[$name])) {
            $this->instances[$name] = $this->receipts[$name]();
        }
        return $this->instances[$name];

    }

}
