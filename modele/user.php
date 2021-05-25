<?php
class user{
    private $connexion;
    private $table="user";
    private $table2="groupesengauin";
    private $table3="vile";


    public $id_user;
    public $login;
    public $pass_word;
    public $nom;
    public $prenom;
    public $age;
    public $sexe;
    public $role;
    public $adresse;
    public $email;
    public $num_tel;
    public $id_vile;
    public $id_grp_seg;
    public $nom_grp_seg;
    public $nom_vile;
    public $num_wilaya;
    public $ville;

    public function __construct($db){
        $this->connexion= $db;
    }

    public function lire()
    {
        $sql="SELECT * FROM user"  ;
        $query=$this->connexion->prepare($sql);
        $query->execute();
        return $query;

    }

    public function rechercher(){
        if(!empty($_POST["nom_grp_seg"])){

          $sql=" SELECT login,pass_word,nom,prenom,age,sexe,role,adresse,email,num_tel,nom_grp_seg,nom_vile,num_wilaya FROM " .$this->table. " u," .$this->table2. " g,"  
         .$this->table3. " v  WHERE u.id_grp_seg = g.id_grp_seg and u.id_vile = v.id_vile and g.nom_grp_seg LIKE :nom_grp_seg ";
        
        $query=$this->connexion->prepare($sql);
        $query->bindParam(":nom_grp_seg", $_POST["nom_grp_seg"]);
        $query->execute();
        return $query;
        }else{
            $sql=" SELECT login,pass_word,nom,prenom,age,sexe,role,adresse,email,num_tel,nom_grp_seg,nom_vile,num_wilaya FROM " .$this->table. " u," .$this->table2. " g,"  
           .$this->table3. " v  WHERE u.id_grp_seg = g.id_grp_seg and u.id_vile = v.id_vile  ";
           $query=$this->connexion->prepare($sql);
           $query->bindParam(":nom_grp_seg", $_POST["nom_grp_seg"]);
           $query->execute();
           return $query; 
        }
    }

    public function creer(){

        if(!empty($_POST["login"]) && !empty($_POST["pass_word"]) && !empty($_POST["nom"])
        && !empty($_POST["prenom"]) && !empty($_POST["age"]) && !empty($_POST["sexe"]) && !empty($_POST["role"]) && !empty($_POST["adresse"])
        && !empty($_POST["email"]) && !empty($_POST["num_tel"]) && !empty($_POST["nom_grp_seg"])
        && !empty($_POST["nom_vile"]) && !empty($_POST["num_wilaya"])){

          $sql = "INSERT INTO " . $this->table . " SET login=:login, pass_word=:pass_word,
            nom=:nom, prenom=:prenom, age=:age, sexe=:sexe, role=:role, adresse=:adresse, email=:email, num_tel=:num_tel,
            id_vile=( 
                SELECT id_vile FROM " . $this->table3 . " where nom_vile LIKE :nom_vile and num_wilaya = :num_wilaya
        ), 
            id_grp_seg=(
                SELECT id_grp_seg FROM " .$this->table2. " where nom_grp_seg LIKE :nom_grp_seg 
          )";

            $query = $this->connexion->prepare($sql);

            $this->login=htmlspecialchars(strip_tags($_POST["login"]));
            $this->pass_word=htmlspecialchars(strip_tags($_POST["pass_word"]));
            $this->nom=htmlspecialchars(strip_tags($_POST["nom"]));
            $this->prenom=htmlspecialchars(strip_tags($_POST["prenom"]));
            $this->age=htmlspecialchars(strip_tags($_POST["age"]));
            $this->sexe=htmlspecialchars(strip_tags($_POST["sexe"]));
            $this->role=htmlspecialchars(strip_tags($_POST["role"]));
            $this->adresse=htmlspecialchars(strip_tags($_POST["adresse"]));
            $this->email=htmlspecialchars(strip_tags($_POST["email"]));
            $this->num_tel=htmlspecialchars(strip_tags($_POST["num_tel"]));
            $this->nom_vile=htmlspecialchars(strip_tags($_POST["nom_vile"]));
            $this->num_wilaya=htmlspecialchars(strip_tags($_POST["num_wilaya"]));
            $this->nom_grp_seg=htmlspecialchars(strip_tags($_POST["nom_grp_seg"]));
           

            $query->bindParam(":login", $this->login);
            $query->bindParam(":pass_word", $this->pass_word);
            $query->bindParam(":nom", $this->nom);
            $query->bindParam(":prenom", $this->prenom);
            $query->bindParam(":age", $this->age);
            $query->bindParam(":sexe", $this->sexe);
            $query->bindParam(":role", $this->role);
            $query->bindParam(":adresse", $this->adresse);
            $query->bindParam(":email", $this->email);
            $query->bindParam(":num_tel", $this->num_tel);
            $query->bindParam(":nom_vile", $this->nom_vile);
            $query->bindParam(":num_wilaya", $this->num_wilaya);
            $query->bindParam(":nom_grp_seg", $this->nom_grp_seg);
           

            if($query->execute()){
                return true;
            }
            return false;
        }else{
            echo "veuillez remplir tout les champs";
        }
    }
    
    
    public function modifier(){

        if(!empty($_POST["login"]) && !empty($_POST["pass_word"]) && !empty($_POST["nom"])
        && !empty($_POST["prenom"]) && !empty($_POST["age"]) && !empty($_POST["sexe"]) && !empty($_POST["role"]) && !empty($_POST["adresse"])
        && !empty($_POST["email"]) && !empty($_POST["num_tel"]) && !empty($_POST["nom_grp_seg"])
        && !empty($_POST["nom_vile"]) && !empty($_POST["num_wilaya"]) && !empty($_POST["id_user"])){

            $sql = "UPDATE " . $this->table . " SET login=:login, pass_word=:pass_word,
            nom=:nom, prenom=:prenom, age=:age, sexe=:sexe, role=:role, adresse=:adresse, email=:email, num_tel=:num_tel,
            id_vile=( 
                SELECT id_vile FROM " . $this->table3 . " where nom_vile LIKE :nom_vile and num_wilaya = :num_wilaya
        ), 
            id_grp_seg=(
                SELECT id_grp_seg FROM " .$this->table2. " where nom_grp_seg LIKE :nom_grp_seg 
          )
          where id_user= :id_user";

            $query = $this->connexion->prepare($sql);

            $this->login=htmlspecialchars(strip_tags($_POST["login"]));
            $this->pass_word=htmlspecialchars(strip_tags($_POST["pass_word"]));
            $this->nom=htmlspecialchars(strip_tags($_POST["nom"]));
            $this->prenom=htmlspecialchars(strip_tags($_POST["prenom"]));
            $this->age=htmlspecialchars(strip_tags($_POST["age"]));
            $this->sexe=htmlspecialchars(strip_tags($_POST["sexe"]));
            $this->role=htmlspecialchars(strip_tags($_POST["role"]));
            $this->adresse=htmlspecialchars(strip_tags($_POST["adresse"]));
            $this->email=htmlspecialchars(strip_tags($_POST["email"]));
            $this->num_tel=htmlspecialchars(strip_tags($_POST["num_tel"]));
            $this->nom_vile=htmlspecialchars(strip_tags($_POST["nom_vile"]));
            $this->num_wilaya=htmlspecialchars(strip_tags($_POST["num_wilaya"]));
            $this->nom_grp_seg=htmlspecialchars(strip_tags($_POST["nom_grp_seg"]));
            $this->id_user=htmlspecialchars(strip_tags($_POST["id_user"]));

            $query->bindParam(":login", $this->login);
            $query->bindParam(":pass_word", $this->pass_word);
            $query->bindParam(":nom", $this->nom);
            $query->bindParam(":prenom", $this->prenom);
            $query->bindParam(":age", $this->age);
            $query->bindParam(":sexe", $this->sexe);
            $query->bindParam(":role", $this->role);
            $query->bindParam(":adresse", $this->adresse);
            $query->bindParam(":email", $this->email);
            $query->bindParam(":num_tel", $this->num_tel);
            $query->bindParam(":nom_vile", $this->nom_vile);
            $query->bindParam(":num_wilaya", $this->num_wilaya);
            $query->bindParam(":nom_grp_seg", $this->nom_grp_seg);
            $query->bindParam(":id_user", $this->id_user);

            if($query->execute()){
                return true;
            }
            return false;
        }else{
            echo "veuillez remplir tout les champs";
        }

    }
    
    
    public function supprimer(){

        if(!empty($_POST["id_user"])){
            $sql = "DELETE FROM " . $this->table . " WHERE id_user = :id_user";
            $query = $this->connexion->prepare( $sql );
            $this->id_user=htmlspecialchars(strip_tags($_POST["id_user"]));
            $query->bindParam(":id_user", $this->id_user);

            if($query->execute()){
                return true;
            }
            
            return false;



        }else{
            echo 'veuillez remplir le champ id_user a supprimer';
        }



    }


    




}







    /*public function creer(){
        if(!empty($_POST["login"]) && !empty($_POST["pass_word"]) && !empty($_POST["nom"])
        && !empty($_POST["prenom"]) && !empty($_POST["age"]) && !empty($_POST["sexe"]) && !empty($_POST["role"]) && !empty($_POST["adresse"])
        && !empty($_POST["email"]) && !empty($_POST["num_tel"]) && !empty($_POST["id_vile"])
        && !empty($_POST["id_grp_seg"])){


            $sql = "INSERT INTO " . $this->table . " SET login=:login, pass_word=:pass_word,
            nom=:nom, prenom=:prenom, age=:age, sexe=:sexe, role=:role, adresse=:adresse, email=:email, num_tel=:num_tel,
            id_vile=:id_vile, id_grp_seg=:id_grp_seg";

            $query = $this->connexion->prepare($sql);

            $this->login=htmlspecialchars(strip_tags($_POST["login"]));
            $this->pass_word=htmlspecialchars(strip_tags($_POST["pass_word"]));
            $this->nom=htmlspecialchars(strip_tags($_POST["nom"]));
            $this->prenom=htmlspecialchars(strip_tags($_POST["prenom"]));
            $this->age=htmlspecialchars(strip_tags($_POST["age"]));
            $this->sexe=htmlspecialchars(strip_tags($_POST["sexe"]));
            $this->role=htmlspecialchars(strip_tags($_POST["role"]));
            $this->adresse=htmlspecialchars(strip_tags($_POST["adresse"]));
            $this->email=htmlspecialchars(strip_tags($_POST["email"]));
            $this->num_tel=htmlspecialchars(strip_tags($_POST["num_tel"]));
            $this->id_vile=htmlspecialchars(strip_tags($_POST["id_vile"]));
            $this->id_grp_seg=htmlspecialchars(strip_tags($_POST["id_grp_seg"]));

            $query->bindParam(":login", $this->login);
            $query->bindParam(":pass_word", $this->pass_word);
            $query->bindParam(":nom", $this->nom);
            $query->bindParam(":prenom", $this->prenom);
            $query->bindParam(":age", $this->age);
            $query->bindParam(":sexe", $this->sexe);
            $query->bindParam(":role", $this->role);
            $query->bindParam(":adresse", $this->adresse);
            $query->bindParam(":email", $this->email);
            $query->bindParam(":num_tel", $this->num_tel);
            $query->bindParam(":id_vile", $this->id_vile);
            $query->bindParam(":id_grp_seg", $this->id_grp_seg);

            if($query->execute()){
                return true;
            }
            return false;
        }else{
            echo "veuillez remplir tout les champs";
        }



}





} */







?>