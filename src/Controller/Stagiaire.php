<?php
session_start();

require '../../config/routes.php';
require '../Model/StagiaireModel.php';


if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else {



    if (isset($_GET['mot']))
        $partie_nom = $_GET['mot'];
    
    else
        $partie_nom = "";
    
    $information = info_stagiaire($partie_nom);


    $entetes = array(
        "Opération",
        "Opération",
        "Etudiant",
        "Entreprise",
        "Professeur",
        
    );

    

    $active = ["", "", "active", "", ""];

    echo $twig->render('Stagiaire.twig', ['active' => $active, 'entetes' => $entetes, 'information' => $information] );
    exit;
}
