<?php



session_start(); 

require '../Model/interaction.php'; 






function verifyConnexion(){
    
    if (!(isset($_POST["login"]) && isset($_POST["role"]) && isset($_POST["mdp"])))
    return false;

    return (connexion($_POST["login"], $_POST["role"])==$_POST["mdp"]);  
}




$_SESSION["connected"] = verifyConnexion();
$_SESSION["role"] = ($_POST["role"] == "professeur");



header("Location: http://localhost//isi1_projetfinal/src/Controller/Accueil.php");
exit ;
        


?>
