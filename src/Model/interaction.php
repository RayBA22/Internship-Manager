<?php


/* le dossier model contient toutes les fonctions permettant d'intéragir avec la base de donnée
des requêtes de sélection, mise à jour et de suppression*/

session_start();
require '../../config/database.php';

/* exécute une requête sql passée en arrguments et 
prend un tableau contenant les paramétres à bind dans la reqête */
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


/* Permet de renvoyer le mdp en passant un login et la table (etudiant ou professeur) 
afin de vérifier s'il correspond à celui ecrit par l'utilisateur*/

function connexion($login, $table)
{

    $sql = "SELECT mdp FROM $table WHERE login = :login";


    $result = executeRequete($sql, ['login' => $login]);

    if ($result) {

        return $result[0]['mdp'];
    }

    return null;
}


/* Envoie toute les entreprises qui verifient les conditions passées en arguements */

function info_entreprise($partie_nom = "", $partie_adresse = "", $spec = null)
{
    $partie_nom = '%' . $partie_nom . '%';



    $sql = "SELECT 
                raison_sociale, nom_contact, nom_resp, rue_entreprise, cp_entreprise, 
                ville_entreprise, tel_entreprise, fax_entreprise, email, 
                site_entreprise, niveau, en_activite, libelle, num_entreprise 
            FROM 
                entreprise 
            JOIN 
                spec_entreprise USING(num_entreprise) 
            JOIN 
                specialite USING(num_spec)
            WHERE 
                raison_sociale LIKE '$partie_nom' ";


    if ($partie_adresse != "")
        $sql .=  "  OR  cp_entreprise LIKE '$partie_adresse' OR  
                     ville_entreprise LIKE '$partie_adresse' OR  
                     rue_entreprise LIKE '$partie_adresse' ";


    if ($spec != "" ) {
        $sql .= " OR num_spec = '$spec' ";
    }

    $sql .= " ORDER BY raison_sociale;";


    $result = executeRequete($sql);

    return $result;
}


/*envoie toutes les classes dans la base de données  */
function info_nomClasses()
{

    $sql = "SELECT  num_classe, nom_classe 
    FROM classe;";

    $result = executeRequete($sql);
    return $result;
}

/* envoie tous les stagiaires qui verifient les conditions passées en arguments */

function info_stagiaire($partie_nom = "",  $num_classe = "", $num_prof = "", $num_entreprise = "")
{
    $partie_nom = '%' . $partie_nom . '%';

    $sql = "SELECT 
s.num_etudiant AS num_etudiant,
       s.nom_etudiant AS nom_etudiant,
        s.prenom_etudiant AS prenom_etudiant,
        e.raison_sociale AS raison_sociale,
        p.nom_prof AS nom_professeur,
        p.prenom_prof AS prenom_professeur
            FROM 
                etudiant s
            LEFT JOIN 
                stage st ON s.num_etudiant = st.num_etudiant
            LEFT JOIN 
                entreprise e ON st.num_entreprise = e.num_entreprise
            LEFT JOIN 
                classe c ON s.num_classe = c.num_classe
            LEFT JOIN 
                professeur p ON st.num_prof = p.num_prof
            WHERE 
                s.nom_etudiant LIKE :partie_nom";

    $params = [
        ':partie_nom' => $partie_nom,
    ];

    if (!empty($num_entreprise)) {
        $sql .= " AND st.num_entreprise = :num_entreprise";
        $params[':num_entreprise'] = $num_entreprise;
    }

    if (!empty($num_classe)) {
        $sql .= " AND s.num_classe = :num_classe";
        $params[':num_classe'] = $num_classe;
    }

    if (!empty($num_prof)) {
        $sql .= " AND st.num_prof = :num_prof";
        $params[':num_prof'] = $num_prof;
    }

    $sql .= " ORDER BY s.nom_etudiant, s.prenom_etudiant;";

    $result = executeRequete($sql, $params);

    return $result;
}
/* renvoie tous les professeur (nom, prenom et numéro ) */
function info_professeur()
{

    $sql = "SELECT 
    num_prof, 
    nom_prof, 
    prenom_prof  FROM professeur;";

    $result = executeRequete($sql);
    return $result;
}

/* permet d'ajouter un stage avec lesinfos passés en arguments */
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

/*  renvoie toutes les spécialités dans la base*/

function info_sepcialite()
{
    $sql = "SELECT num_spec, libelle FROM specialite";


    $result = executeRequete($sql);

    return $result;
}
