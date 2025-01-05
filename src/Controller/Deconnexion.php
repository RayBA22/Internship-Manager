<?php

/* Permet de déconnecter un utilisateur en  appuyant sur deconnexion sur la barre*/


session_start();
$_SESSION["connected"] = false;
session_destroy();
header("Location: http://localhost//isi1_projetfinal/src/Controller/Accueil.php");
exit ;