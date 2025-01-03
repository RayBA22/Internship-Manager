
<?php
require 'interaction.php';


function info_stagiaire($partie_nom)
{

    $partie_nom = '%' . $partie_nom . '%';

    $sql = "SELECT 
        e.nom_etudiant AS nom_etudiant,
        e.prenom_etudiant AS prenom_etudiant,
        en.raison_sociale AS raison_sociale,
        p.nom_prof AS nom_professeur,
        p.prenom_prof AS prenom_professeur
        FROM 
            etudiant e
        LEFT JOIN 
            stage s ON e.num_etudiant = s.num_etudiant
        LEFT JOIN 
            entreprise en ON s.num_entreprise = en.num_entreprise
        LEFT JOIN 
            professeur p ON s.num_prof = p.num_prof";

    $sql .= " WHERE nom_etudiant LIKE :partie_nom";

    $sql .= " ORDER BY nom_etudiant;";


    $result = executeRequete($sql, ['partie_nom' => $partie_nom]);
    return $result;
}
