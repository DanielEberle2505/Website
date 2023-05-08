<?php

include "../views/Layout/header.php";
include "../init.php";

//Block, der im wesentlichen überprüft, ob der User eingeloggt ist und den User, falls er es nicht ist auf die Loginseite weiterleitet.
session_start();
if (isset($_SESSION['id']) || $_SERVER['PATH_INFO'] == '/login' or $_SERVER['PATH_INFO'] == '/register' or $_SERVER['PATH_INFO'] == '/newPassword') {
}
else {
    header('location:/Website/public/index.php/login');
}

//Variable zum erfassen der aufgerufenen Route
$pathInfo = $_SERVER['PATH_INFO'];
//Variable, die, die Routes beinhaltet, sowie Blaupausen zur view dieser
$routes = [
    '/index' => [           //Blaupause, für die view "index.php"
        'class' => 'gamesController',
        'method' => 'index'
    ],
    '/game' => [            //Blaupause, für die view "show.php"
        'class' => 'gamesController',
        'method' => 'show'
    ],

    '/login' => [           //Blaupause, für die view "login.php"
        'class' => 'usersController',
        'method' => 'login'],

    '/register' => [        //Blaupause, für die view "register.php"
        'class' => 'usersController',
        'method' => 'register'],

    '/userlist' => [        //Blaupause, für die view "userlist.php"
        'class' => 'usersController',
        'method' => 'showUserlist'],

    '/addGame' => [         //Blaupause, für die view "addGame.php"
        'class' => 'gamesController',
        'method' => 'add'],

    '/edit' => [            //Blaupause, für die view "edit.php"
        'class' => 'gamesController',
        'method' => 'edit'],
    '/logout' => [            //Blaupause, für die view "logout.php"
        'class' => 'usersController',
        'method' => 'logout'],
    '/cart' => [            //Blaupause, für die view "cart.php"
      'class' => 'gamesController',
      'method' => 'showCart'],
    '/payment' => [            //Blaupause, für die view "payment.php"
        'class' => 'gamesController',
        'method' => 'payment'],
    '/newPassword' => [            //Blaupause, für die view "newPassword.php"
        'class' => 'usersController',
        'method' => 'newPass'],
    '/user' => [            //Blaupause, für die view "user.php"
        'class' => 'usersController',
        'method' => 'showUser'],
    '/wiki' => [            //Blaupause, für die view "wiki.php"
        'class' => 'wikiController',
        'method' => 'showEntries'],
    '/showEntry' => [            //Blaupause, für die view "showEntry.php"
        'class' => 'wikiController',
        'method' => 'showEntry'],
    '/addEntry' => [            //Blaupause, für die view "addEntry.php"
        'class' => 'wikiController',
        'method' => 'add'],
    '/editEntry' => [            //Blaupause, für die view "editEntry.php"
        'class' => 'wikiController',
        'method' => 'edit'],
    '/delete' => [            //Blaupause, für die view "delete.php"
        'class' => 'wikiController',
        'method' => 'deleteEntry'],
    '/rating' => [
        'class' => 'gamesController',
        'method' => 'rate'],
    '/deleteGame' => [
        'class' => 'gamesController',
        'method' => 'deleteGame'],
    '/dashboard' => [
        'class' => 'gamesController',
        'method' => 'dashboard'],



];

//If Statement, dass, wenn die $route an der Stelle $pathInfo ($_Server['PATH_INFO'])gesetzt ist,
// die aus der angegebenen $route die angegebene Klasse erstellt und dann die angegebene Methode ausführt (angegeben durch $route)
if (isset($routes[$pathInfo])) {
    $route = $routes[$pathInfo];
    $class = $container->make($route['class']);
    $method = $route['method'];
    $class->$method();
}





include "../views/Layout/footer.php";
