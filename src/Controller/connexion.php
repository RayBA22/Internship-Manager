<?php

session_start(); // Resume the session

$_SESSION["connected"] = true;


header("Location: http://localhost//isi1_projetfinal/src/Controller/Accueil.php");
exit ;
        


?>
