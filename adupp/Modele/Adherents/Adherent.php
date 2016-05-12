<?php
class Adherent
{
	private $id_adherent;
    private $pseudo;
    private $password;
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $description;
    private $possede_bateau;
	
        
    //public function __construct(){}

    public function __construct( $id_adherent, $pseudo, $password, $nom, $prenom, $email, $telephone, $description, $possede_bateau)
    {
    	$this->id_adherent = $id_adherent;
    	$this->pseudo = $pseudo;
        $this->password = $password;
    	$this->nom = $nom;
    	$this->prenom = $prenom;
    	$this->telephone = $telephone;
    	$this->email = $email;
    	$this->description = $description;
    	$this->possede_bateau = $possede_bateau;
    }
    
    public function getID() {
        return $this->id_adherent;        
    }
    
    public function setID($id){
        $this->id_adherent = (int) $id;
    }
    
    public function getPassword() {
        return $this->password;        
    }
    
    public function setAdherent($password){
        $this->password = $password;
    }
    
    public function getNom() {
        return $this->nom;        
    }
    
    public function setNom($nom){
        $this->nom = $nom;
    }
    
    public function getPrenom() {
        return $this->prenom;        
    }
    
    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }
    
    public function getPseudo() {
        return $this->pseudo;        
    }
    
    public function setPseudo($date){
        $this->pseudo = $pseudo;
    }
    
    public function getTelephone() {
        return $this->telephone;        
    }
    
    public function setTelephone($telephone){
        $this->telephone = $telephone;
    }
    
    public function getEmail() {
        return $this->email;        
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function getDescription() {
        return $this->description;        
    }
    
    public function setDescription($description){
        $this->description = $description;
    }
    
    public function getPossedeBateau() {
        return $this->possede_bateau;        
    }
    
    public function setPossedeBateau($possede_bateau){
        $this->possede_bateau = $possede_bateau;
    }
    
}
?>