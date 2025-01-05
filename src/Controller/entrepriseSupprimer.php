<?php

/* Supprime une entreprise en cliquant sur le x et redirige vers la page d'entreprise*/

session_start();

require '../../config/routes.php';
require '../Model/EntrepriseModel.php';


if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else{
    
    if (isset($_GET['id']))
        supprimer_entreprise($_GET['id']);

    
    header("Location: http://localhost//isi1_projetfinal/src/Controller/Entreprise.php");
    exit ;
}