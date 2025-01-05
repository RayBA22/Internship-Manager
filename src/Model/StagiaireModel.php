
<?php

/* Ces fonctions sont  utilisées dans le controller liée aux stagiaires */

require 'interaction.php';



function info_stagiaire2($id)
{

    $sql = "SELECT 
        e.num_etudiant AS num_etudiant,
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

function info_stagiaire_stages($id)
{

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






function mettreAjour_stagiaire($id, $nom, $prenom, $annee_obtention, $num_classe)
{
    $sql = "UPDATE etudiant
            SET 
                nom_etudiant = :nom,
                prenom_etudiant = :prenom,
                annee_obtention = :annee_obtention,
                num_classe = :num_classe
            WHERE 
                num_etudiant = :id";

    return executeRequete($sql, [
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':annee_obtention' => $annee_obtention,
        ':num_classe' => $num_classe,
        ':id' => $id
    ]);
}



function ajouter_stagiaire($nom, $prenom, $login, $mdp, $annee_obtention, $num_classe)
{
    $sql = "INSERT INTO etudiant (
        nom_etudiant, 
        prenom_etudiant, 
        login, 
        mdp, 
        annee_obtention, 
        num_classe
    ) VALUES (
        :nom, 
        :prenom, 
        :login, 
        :mdp, 
        :annee_obtention, 
        :num_classe
    )";

    return executeRequete($sql, [
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':login' => $login,
        ':mdp' => $mdp,
        ':annee_obtention' => $annee_obtention,
        ':num_classe' => $num_classe
    ]);

    
}


function supprimer_stagiaire($id) {
    
    $sql = "DELETE FROM mission WHERE num_stage IN (SELECT num_stage FROM stage WHERE num_etudiant = $id);";
    executeRequete($sql);
    $sql = "DELETE FROM stage WHERE num_etudiant = $id;";
    executeRequete($sql);

    $sql = "DELETE FROM prof_classe WHERE num_classe IN (SELECT num_classe FROM etudiant WHERE num_etudiant = $id);";
    executeRequete($sql);

    $sql = "DELETE FROM etudiant WHERE num_etudiant = $id;";
    $result = executeRequete($sql);

    return $result;
}
