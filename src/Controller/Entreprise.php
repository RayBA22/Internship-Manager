<?php
session_start();

require '../../config/routes.php';
require '../Model/EntrepriseModel.php';


if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else {

    if (isset($_GET['mot']))
        $partie_nom = $_GET['mot'];
    
    else
        $partie_nom = "";

    $information = info_entreprise($partie_nom);
    $entetes = $entetes = array(
        "Opération",
        "Raison sociale",
        "Nom du responsable",
        "Adresse",
        "libelle",
        "Site web",
        "Email",
        "Teléphone et Fax",
        "Niveau",
        "En activite?",

    );

    $active = ["", "active", "", "", ""];

    echo $twig->render('Entreprise.twig', [ 'active'=> $active, 'role' => $_SESSION["role"], 'information' => $information, 'entetes' => $entetes]);
    exit;
}
