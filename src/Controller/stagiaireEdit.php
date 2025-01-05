<?php


/*Modifie les informations d'un stagiaire */

session_start();

require '../../config/routes.php';
require '../Model/StagiaireModel.php';


if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else {

    
    if (
        isset($_GET['id']) && !empty($_GET['id']) &&
        isset($_POST['nom_etudiant']) &&
        isset($_POST['prenom_etudiant'])&&
        isset($_POST['annee_obtention']) &&
        isset($_POST['num_classe']) 

    ) {

        

        $id = $_GET['id'];
        $nom_etudiant = htmlspecialchars($_POST['nom_etudiant']) ;
        $prenom_etudiant =  htmlspecialchars($_POST['prenom_etudiant']);
        $annee_obtention = !empty($_POST['annee_obtention']) ? htmlspecialchars($_POST['annee_obtention'], ENT_QUOTES, 'UTF-8') : null;
        $num_classe =  htmlspecialchars($_POST['num_classe']) ;

        
        echo("çamrche");


        mettreAjour_stagiaire($id, $nom_etudiant, $prenom_etudiant, $annee_obtention, $num_classe);



        header("Location: http://localhost//isi1_projetfinal/src/Controller/Stagiaire.php");
        exit;
    }
}
