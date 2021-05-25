<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../connexion/connexion.php';
    include_once '../modele/user.php';

    // On instancie la base de données
    $database = new database();
    $db = $database->getConnection();

    // On instancie les utilisateur
    $user = new user($db);

    // On récupère l'id du user
    $donnees = json_decode(file_get_contents("php://input"));


    if($user->supprimer()){
        // Ici la suppression a fonctionné
        // On envoie un code 200
        http_response_code(200);
        echo json_encode(["message" => "La suppression a été effectuée"]);
    }else{
        // Ici la création n'a pas fonctionné
        // On envoie un code 503
        http_response_code(503);
        echo json_encode(["message" => "La suppression n'a pas été effectuée"]);         
    }


}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}


?>