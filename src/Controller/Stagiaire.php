<?php

/* affiche la liste des stagiaires */

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


    if (isset($_GET['alphabet']) && isset($_GET['classe']) && isset($_GET['prof']) && isset($_GET['entreprise']))
        $information = info_stagiaire($_GET['alphabet'], $_GET['classe'], $_GET['prof'], $_GET['entreprise']);

    else
        $information = info_stagiaire();



    $entetes = array(
        "Opération",
        "Opération",
        "Etudiant",
        "Entreprise",
        "Professeur",

    );

    $entreprises = info_entreprise();
    $classes = info_nomClasses();
    $profs = info_professeur();
    $active = ["", "", "active", "", ""];

    echo $twig->render('Stagiaire.twig', ['active' => $active, 'entreprises' => $entreprises, 'classes' => $classes,   'profs' => $profs, 'entetes' => $entetes, 'information' => $information]);
    exit;
}
