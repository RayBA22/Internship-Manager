<?php
session_start();

require '../../config/routes.php';
require '../Model/interaction.php';


if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else {


    $information = info_entreprise();
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
