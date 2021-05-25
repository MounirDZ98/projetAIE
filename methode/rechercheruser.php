<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../connexion/connexion.php';
    include_once '../modele/user.php';

    // On instancie la base de données
    $database = new database();
    $db = $database->getConnection();

    
    $user = new user($db);

    $donnees = json_decode(file_get_contents("php://input"));


    $stmt=$user->rechercher();
       if($stmt->rowCount() > 0){

        $tableauUser = [];
        $tableauUser['user'] = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            

            $userr = [
               
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
                "nom_grp_seg" => $nom_grp_seg,
                "nom_vile" => $nom_vile,
                "num_wilaya" => $num_wilaya
            ];

            $tableauUser['user'][] = $userr;
        }

        http_response_code(200);
        echo json_encode($tableauUser);
        echo json_encode("le nombre resultat est " . $stmt->rowCount() . " user");
    }

}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
?>