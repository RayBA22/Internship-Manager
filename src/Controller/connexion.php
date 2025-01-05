<?php

/* verifie si les informations de connexions sont correctes*/

session_start(); 

require '../Model/interaction.php'; 






function verifyConnexion(){
    
    if (!(isset($_POST["login"]) && isset($_POST["role"]) && isset($_POST["mdp"])))
    return false;

    return (connexion($_POST["login"], $_POST["role"])==$_POST["mdp"]);  
}


/* On utilise $_SESSION pour stocker deux informations: un boolean true 
 l'utilisateur est connecté false sinon.
 une autre pour savoir si c'est un prof ou unétudiant qui s'est connecté afin e personnalise l'affichage
*/

$_SESSION["connected"] = verifyConnexion();
$_SESSION["role"] = ($_POST["role"] == "professeur");



header("Location: http://localhost//isi1_projetfinal/src/Controller/Accueil.php");
exit ;
        


?>
