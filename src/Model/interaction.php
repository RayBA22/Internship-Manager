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


//j'ai enlev observation parce que y'a rien dedns
function info_entreprise()
{

    $sql = "SELECT raison_sociale, nom_contact, nom_resp, rue_entreprise, cp_entreprise, ville_entreprise, tel_entreprise, fax_entreprise, email, 
  site_entreprise, niveau, en_activite, libelle, num_entreprise FROM entreprise JOIN spec_entreprise using(num_entreprise) join specialite using(num_spec) 
  ORDER BY raison_sociale;";
    $result = executeRequete($sql);
    return $result;
}

function info_entreprise2($id)
{

    $sql = "SELECT raison_sociale, nom_contact, nom_resp, rue_entreprise, cp_entreprise, ville_entreprise, tel_entreprise, fax_entreprise, email, 
  site_entreprise, niveau, en_activite, libelle, num_entreprise FROM entreprise JOIN spec_entreprise using(num_entreprise) join specialite using(num_spec) 
  WHERE num_entreprise = $id;";
    $result = executeRequete($sql);
    return $result[0];
}

