<?php

/* Affiche la page d'accueil si l'utilisateur est connecté */

/* Les fichiers dans le dossier Controller qui commençent par une majuscule 
affichent un template twig les autres effectuent une opération (suppression ajout ...).
Ces fichiers avec une majuscule contiennent tous une variable $active qui permet aux templates de choisir q
quelles partie il faut selectionner dans la barre de navigation (pour le style uniquement)*/

session_start();

require '../../config/routes.php';

/*  tous les fichiers .php du Controller vérifient la connexion avant 
d'afficher les templates ou d'effectuer dees opérations */
if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else {



    $active = ["active", "", "", "", ""];
    echo $twig->render('Accueil.twig', ['active' => $active]);
    exit;
}
