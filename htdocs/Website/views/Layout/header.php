<!DOCTYPE html>
<html lang="en" style="height:100%">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Gamepage</title>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="payment.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style><?php include "style.css";?></style>
</head>
<body style="height:100%; width:100%; background-color:Gainsboro">
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <?php session_start();
            if(isset($_SESSION['id'])):?>
            <a class="navbar-brand" href="/Website/public/index.php/index">Gamepage</a>
            <?php endif;?>
        </div>


        <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <?php session_start();

            if (isset($_SESSION['role']) && $_SESSION['role'] == 0 && $_SERVER['PATH_INFO'] == "/index") {
                ?>
                <li><a href="/Website/public/index.php/userlist">Userlist</a></li>
                <li><a href="/Website/public/index.php/addGame">Add Game</a></li>
                <li><a href="/Website/public/index.php/wiki">Wiki</a></li>
                <li><a href="dashboard">Dashboard</a><li>
                <?php
            } elseif (isset($_SESSION['role']) && $_SESSION['role'] == 1 && $_SERVER['PATH_INFO'] == "/index") {
                ?>
                <li><a href="/Website/public/index.php/addGame">Add Game</a></li>
                <li><a href="dashboard">Dashboard</a><li>
                <?php
            }elseif(isset($_SESSION['role']) && $_SESSION['role'] == 2 && !$_SERVER['PATH_INFO'] == "/dashboard") {
              ?><li><a href="dashboard">Dashboard</a><li><?php
            }
            ?>
        </ul>
        <?php
        session_start();
        if (isset($_SESSION['id'])) {
            ?>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="/Website/public/index.php/cart"><span class="glyphicon glyphicon-shopping-cart"> Shopping-Basket</a>

                <li><a href="/Website/public/index.php/logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
            </ul>
            <?php
        } else {
            ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href='/Website/public/index.php/register'><span class='glyphicon glyphicon-user'></span> Sign Up</a>
                </li>
                <li><a href="/Website/public/index.php/login"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                </li>
            </ul>
            <?php
        }

        ?>
        </div>
    </div>
</nav>
</br>
</br>
</br>
<?php ?>
