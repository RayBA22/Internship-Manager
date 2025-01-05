<?php

/* Supprime un stagiaire et envoie vers la liste des stagiaires */
session_start();

require '../../config/routes.php';
require '../Model/StagiaireModel.php';


if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else{
    
    if (isset($_GET['id']))
        supprimer_stagiaire($_GET['id']);

    
    header("Location: http://localhost//isi1_projetfinal/src/Controller/Stagiaire.php");
    exit ;
}