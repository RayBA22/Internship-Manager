<?php
session_start();

require '../../config/routes.php';
require '../Model/StagiaireModel.php';


if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else {

    
    if (
        isset($_POST['nom_etudiant']) &&
        isset($_POST['login']) &&
        isset($_POST['mdp']) &&
        isset($_POST['prenom_etudiant'])&&
        isset($_POST['annee_obtention']) &&
        isset($_POST['num_classe']) 

    ) {

        

        
        $nom_etudiant = htmlspecialchars($_POST['nom_etudiant']) ;
        $prenom_etudiant =  htmlspecialchars($_POST['prenom_etudiant']);
        $login = htmlspecialchars($_POST['login']);
        $mdp = htmlspecialchars($_POST['mdp']);
        $annee_obtention = !empty($_POST['annee_obtention']) ? htmlspecialchars($_POST['annee_obtention'], ENT_QUOTES, 'UTF-8') : null;
        $num_classe =  htmlspecialchars($_POST['num_classe']) ;

        
        echo("çamrche");


        ajouter_stagiaire($nom_etudiant, $prenom_etudiant, $login, $mdp, $annee_obtention, $num_classe);



        header("Location: http://localhost//isi1_projetfinal/src/Controller/Stagiaire.php");
        exit;
    }
}
