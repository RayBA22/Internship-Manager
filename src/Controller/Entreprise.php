<?php
session_start();

require '../../config/routes.php';


if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {

    echo $twig->render('connexion.twig');
    exit;
} else {

    echo $twig->render('Entreprise.twig');
    exit;
}
