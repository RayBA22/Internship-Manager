<?php
session_start();

require '../../config/routes.php';
require '../Model/Interaction.php';


if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else {

    $entreprise = null;
    
    if(isset($_GET['id']))
        $entreprises = $_GET['id'];
    else
        $entreprises = info_entreprise();


    $stagiaires = info_stagiaire();

    $professeurs = info_professeur();


    $active = ["", "", "", "active", ""];

    echo $twig->render('Inscription.twig', [ 'active' => $active, 'entreprises' => $entreprises, 'stagiaires' => $stagiaires, 'professeurs' => $professeurs]);
    exit;
}
