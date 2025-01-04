<?php
session_start();

require '../../config/routes.php';
require '../Model/EntrepriseModel.php';


if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else {



    if (
        isset($_GET['id']) && !empty($_GET['id']) &&
        isset($_POST['raison_sociale']) && !empty($_POST['raison_sociale']) &&
        isset($_POST['rue_entreprise']) && !empty($_POST['rue_entreprise']) &&
        isset($_POST['cp_entreprise']) && !empty($_POST['cp_entreprise']) &&
        isset($_POST['ville_entreprise']) && !empty($_POST['ville_entreprise']) &&
        isset($_POST['tel_entreprise']) && !empty($_POST['tel_entreprise']) &&
        isset($_POST['niveau']) && !empty($_POST['niveau']) &&
        isset($_POST['specialite']) && !empty($_POST['specialite'])

    ) {


        $id = $_GET['id'];
        $raison_sociale = htmlspecialchars($_POST['raison_sociale']);
        $nom_contact = htmlspecialchars($_POST['nom_contact']);
        $nom_resp = htmlspecialchars($_POST['nom_resp']);
        $rue_entreprise = htmlspecialchars($_POST['rue_entreprise']);
        $cp_entreprise = htmlspecialchars($_POST['cp_entreprise']);
        $ville_entreprise = htmlspecialchars($_POST['ville_entreprise']);
        $tel_entreprise = htmlspecialchars($_POST['tel_entreprise']);
        $fax_entreprise = htmlspecialchars($_POST['fax_entreprise']);
        $email = htmlspecialchars($_POST['email']);
        $observations = htmlspecialchars($_POST['observations']);
        $site = htmlspecialchars($_POST['site']);
        $niveau = htmlspecialchars($_POST['niveau']);
        $specialite = htmlspecialchars($_POST['specialite']);


       


        echo mettreAjour_entreprise(
            $id,
            $raison_sociale,
            $nom_contact,
            $nom_resp,
            $rue_entreprise,
            $cp_entreprise,
            $ville_entreprise,
            $tel_entreprise,
            $fax_entreprise,
            $email,
            $observations,
            $site,
            $niveau,
            $specialite
            
        );

        header("Location: http://localhost//isi1_projetfinal/src/Controller/Entreprise.php");
        exit;
    }
}
