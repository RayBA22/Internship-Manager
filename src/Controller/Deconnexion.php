<?php

session_start();
$_SESSION["connected"] = false;
session_destroy();
header("Location: http://localhost//isi1_projetfinal/src/Controller/Accueil.php");
exit ;