<?php

session_start();
require '../../config/database.php';

// Function to execute SQL queries
function executeRequete($sql, $params = [])
{
    global $pdo;
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}


function connexion($login, $table)
{

    $sql = "SELECT mdp FROM $table WHERE login = :login";


    $result = executeRequete($sql, ['login' => $login]);

    if ($result) {

        return $result[0]['mdp'];
    }

    return null;
}


function info_entreprise($partie_nom="")
{

    $partie_nom = '%' . $partie_nom . '%';

    $sql = "SELECT raison_sociale, nom_contact, nom_resp, rue_entreprise, cp_entreprise, ville_entreprise, tel_entreprise, fax_entreprise, email, 
  site_entreprise, niveau, en_activite, libelle, num_entreprise FROM entreprise JOIN 
  spec_entreprise using(num_entreprise) join specialite using(num_spec) ";

    $sql .= " WHERE raison_sociale LIKE :partie_nom";


    $sql .= " ORDER BY raison_sociale ;";


    $result = executeRequete($sql, ['partie_nom' => $partie_nom]);
    return $result;
}



function info_stagiaire($partie_nom="")
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



function info_professeur()
{

    $sql = "SELECT 
    num_prof, 
    nom_prof, 
    prenom_prof  FROM professeur;";

    $result = executeRequete($sql);
    return $result;
}


function ajouter_inscription(
    $debut_stage,
    $fin_stage,
    $type_stage,
    $desc_projet,
    $observation_stage,
    $num_etudiant,
    $num_prof,
    $num_entreprise
) {

    $sql = "INSERT INTO stage (
        debut_stage, fin_stage, type_stage, desc_projet, observation_stage, 
        num_etudiant, num_prof, num_entreprise
    ) 
    VALUES (
        :debut_stage, :fin_stage, :type_stage, :desc_projet, :observation_stage, 
        :num_etudiant, :num_prof, :num_entreprise
    )";

    $param = [
        ':debut_stage' => $debut_stage,
        ':fin_stage' => $fin_stage,
        ':type_stage' => $type_stage,
        ':desc_projet' => $desc_projet,
        ':observation_stage' => $observation_stage,
        ':num_etudiant' => $num_etudiant,
        ':num_prof' => $num_prof,
        ':num_entreprise' => $num_entreprise
    ];


    return executeRequete($sql, $param);
}
