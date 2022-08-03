<?php

session_start();
//constante d'envoronnement
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "autocompletion");

//DSN de connexion (data source name)
$dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST;

// on va se connecter a la base a travers un try catch pour gerer l'exeption levé par pdo
try {
    //on va instancie PDO
    $bdd = new PDO($dsn, DBUSER, DBPASS);

    //On s'assure d'envoyer les données en utf8
    $bdd->exec("SET NAMES utf8");

    //on definit le mode de fetch par defaut
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,  PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion a la base: " . $e->getMessage());
}





$search = isset($_POST['search']) ? strip_tags($_POST['search']) : '';


$sqlVerif = "SELECT * FROM `country` WHERE name LIKE :search ORDER BY name LIMIT 10";

//ON PREPARE LA REQUETE
$requete = $bdd->prepare($sqlVerif);

//ON EXECUTE LA REQUETE
$requete->execute(array(':search' => '%' . $search . '%'));

    

$result = $requete->fetchAll();


// $replaceString = '<b>' . $search . '</b>';
// foreach ($result as $key => $value) {
// }




echo json_encode($result);
