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



