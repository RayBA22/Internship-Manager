<?php
session_start();

require '../../config/routes.php';
require '../Model/StagiaireModel.php';


if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else {

    $information = array();
    $classes = info_nomClasses();    
    if (isset($_GET['id']))
        $information = info_stagiaire2($_GET['id']);
    

    $active = ["", "", "active", "", ""];


    echo $twig->render('StagiaireEdit.twig', [ 'active'=> $active, 'info' => $information, 'classes' => $classes]);
    exit;
}
