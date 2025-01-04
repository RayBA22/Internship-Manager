<?php
session_start();

require '../../config/routes.php';
require '../Model/StagiaireModel.php';


if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else {

    $information = array();
    $stages = array();
    if (isset($_GET['id']))
        $information = info_stagiaire2($_GET['id']);
        $stages = info_stagiaire_stages($_GET['id']);
    

    $active = ["", "", "active", "", ""];

    
    echo $twig->render('StagiaireInfo.twig', [ 'active'=> $active, 'info' => $information, 'stages' => $stages]);
    exit;
}
