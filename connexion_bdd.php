<?php
define("hostname","serveurmysql"); 
define("database","BDD_llambalo");
define("username","llambalo"); 
define("password","2605");

$dsn = 'mysql:dbname='.database.';host='.hostname.';charset=utf8';    

$bdd = new PDO($dsn, username, password);
             // pour afficher les erreurs
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             // pour récupérer le résultat des requêtes SELECT sous forme de tableaux associatifs 
$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);