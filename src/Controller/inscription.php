
<?php

/* ajoute une inscription a un stage à partir des 
information revoyée par le formulaire inscription.twig
envoie vers la page stagiaire*/

session_start();


require '../../config/routes.php';
require '../Model/interaction.php';


if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else {

    
    $num_entreprise = isset($_POST['num_entreprise']) && !empty($_POST['num_entreprise']) 
        ? htmlspecialchars($_POST['num_entreprise']) 
        : null;

    $num_stagiaire = isset($_POST['num_stagiaire']) && !empty($_POST['num_stagiaire']) 
        ? htmlspecialchars($_POST['num_stagiaire']) 
        : null;

    $num_prof = isset($_POST['num_prof']) && !empty($_POST['num_prof']) 
        ? htmlspecialchars($_POST['num_prof']) 
        : null;

    $debut_stage = isset($_POST['debut_stage']) && !empty($_POST['debut_stage']) 
        ? htmlspecialchars($_POST['debut_stage']) 
        : null;

    $fin_stage = isset($_POST['fin_stage']) && !empty($_POST['fin_stage']) 
        ? htmlspecialchars($_POST['fin_stage']) 
        : null;

    $type_stage = isset($_POST['type_stage']) && !empty($_POST['type_stage']) 
        ? htmlspecialchars($_POST['type_stage']) 
        : null;

    $desc_stage = isset($_POST['desc_stage']) && !empty($_POST['desc_stage']) 
        ? htmlspecialchars($_POST['desc_stage']) 
        : null;

    $observation_stage = isset($_POST['observation_stage']) && !empty($_POST['observation_stage']) 
        ? htmlspecialchars($_POST['observation_stage']) 
        : null;


        ajouter_inscription(
            $debut_stage,
            $fin_stage,
            $type_stage,
            $desc_projet,
            $observation_stage,
            $num_stagiaire,
            $num_prof,
            $num_entreprise
        );

    header("Location: http://localhost//isi1_projetfinal/src/Controller/Stagiaire.php");
    exit;
}
