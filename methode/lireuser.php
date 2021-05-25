<?php
header("Access-Control-Allow-Origin: *");// api public
header("Content-Type: application/json; charset=UTF-8");//le contenu de la réponse en json
header("Access-Control-Allow-Methods: GET");// autoriser ou intredir l'accés a notre api n en fonction de l'origine du utilisateur 
header("Access-Control-Max-Age: 3600");// la durée de vie de la requete
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");// quelle sont les header q'ont autorise aux niveau de la requete, quelle sont les header q'ont autorise vise à vie de poste client 

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../connexion/connexion.php';
    include_once '../modele/user.php';

    // On instancie la base de données
    $database = new database();
    $db = $database->getConnection();

    // On instancie les utilisateurs
    $user = new user($db);

    // On récupère les données
    $stmt = $user->lire();

    if($stmt->rowCount() > 0){
        // On initialise un tableau associatif
        $tableauUser = [];
        $tableauUser['user'] = [];

        // On parcourt les utilisateurs
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $userr = [
                "id_user" => $id_user,
                "login" => $login,
                "pass_word" => $pass_word,
                "nom" => $nom,
                "prenom" => $prenom,
                "age" => $age,
                "sexe" => $sexe,
                "role" => $role,
                "adresse" => $adresse,
                "email" => $email,
                "num_tel" => $num_tel,
                "id_vile" => $id_vile,
                "id_grp_seg" => $id_grp_seg

                
            ];

            $tableauUser['user'][] = $userr;
            
        }

        // On envoie le code réponse 200 OK
        http_response_code(200);

        // On encode en json et on envoie
        echo json_encode($tableauUser);
        
    }



}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}


?>