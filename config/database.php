<?php

/*
   ce fichier permet de se connecter à une base de données MySQL locale avec des paramètres 
   spécifiés et une gestion des erreurs via les exceptions de PDO.

*/



$host = '127.0.0.1'; 
$db = 'bdd_geststages';     
$user = 'root';       
$pass = '';           
$charset = 'utf8mb4'; 

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
