<?php
session_start();

require '../../config/routes.php';
require '../Model/interaction.php';


if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else {
    
    $entreprises = null;
    $nom_entreprise = null;
    
    if(isset($_GET['id']) && isset($_GET['nom'])){
        $entreprises = $_GET['id'];
        $nom_entreprise = $_GET['nom'];
}
    else
        $entreprises = info_entreprise();


    $stagiaires = info_stagiaire();

    $professeurs = info_professeur();


    $active = ["", "", "", "active", ""];

    echo $twig->render('Inscription.twig', [ 'active' => $active, 'nom_entreprise' => $nom_entreprise, 'entreprises' => $entreprises, 'stagiaires' => $stagiaires, 'professeurs' => $professeurs]);
    exit;
}
