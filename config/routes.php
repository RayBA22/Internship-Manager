<?php
session_start();

/*
  Permet d'instancier le twig loader pour trouver les templates dans $loader
    initialise l'environnement twig dans la variable $twig

*/


require_once '../../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('../View');
$twig = new \Twig\Environment($loader);


