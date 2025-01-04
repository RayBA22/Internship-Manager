
<?php
require 'interaction.php';


function info_stagiaire($partie_nom)
{

    $partie_nom = '%' . $partie_nom . '%';

    $sql = "SELECT 
         e.num_etudiant AS num_etudiant,
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


function info_stagiaire2($id)
{

    $sql = "SELECT 
        e.nom_etudiant AS nom_etudiant,
        e.prenom_etudiant AS prenom_etudiant,
        e.annee_obtention AS annee_obtention,

        c.nom_classe AS nom_classe,
        p.nom_prof AS nom_professeur,
        p.prenom_prof AS prenom_professeur
        FROM 
            etudiant e
        LEFT JOIN 
            classe c ON e.num_classe = c.num_classe
        LEFT JOIN 
            prof_classe pc ON c.num_classe = pc.num_classe AND pc.est_prof_principal = 1
        LEFT JOIN 
            professeur p ON pc.num_prof = p.num_prof
        WHERE 
        e.num_etudiant = :id;";
    $result = executeRequete($sql, [':id' => $id]);
    return $result[0];
}

function info_stagiaire_stages($id){

    $sql = "SELECT 
    s.debut_stage AS debut_stage,
    s.fin_stage AS fin_stage,
    s.type_stage AS type_stage,
    s.desc_projet AS desc_projet,
    s.observation_stage AS observation_stage,
    en.raison_sociale AS raison_sociale
FROM 
    etudiant e
LEFT JOIN 
    stage s ON e.num_etudiant = s.num_etudiant
LEFT JOIN 
    entreprise en ON s.num_entreprise = en.num_entreprise
WHERE 
    e.num_etudiant = :id ;";



$result = executeRequete($sql, [':id' => $id]);
    return $result;


}

