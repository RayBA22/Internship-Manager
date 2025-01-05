<?php
session_start();

require '../../config/routes.php';
require '../Model/EntrepriseModel.php';


if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else {

    if (isset($_GET['mot']) && isset($_GET['adresse']) && isset($_GET['spec']))
        $information = info_entreprise($_GET['mot'], $_GET['adresse'], $_GET['spec']);

    else
        $information = info_entreprise();



    $specialites = info_sepcialite();

    $entetes = $entetes = array(
        "Opération",
        "Raison sociale",
        "Nom du responsable",
        "Adresse",
        "spcialité",
        "Site web",
        "Email",
        "Teléphone et Fax",
        "Niveau",
        "En activite?",

    );

    

    $active = ["", "active", "", "", ""];


    echo $twig->render('Entreprise.twig', ['active' => $active, 'specialites' => $specialites, 'role' => $_SESSION["role"], 'information' => $information, 'entetes' => $entetes]);
    exit;
}
