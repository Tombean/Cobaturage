<?php


require_once('Modele/Adherents/Adherent.php');
require_once('Modele/Lieux/Lieu.php');
require_once('Modele/Types/Type.php');
class Annonce
{
	private $id_annonce;
	private $adherent;
	private $lieu;
	private $date_creation;
	private $date_debut;
	private $date_fin;
	private $type;
	private $cherche;
	private $participation;
	private $commentaire;
         
    public function __construct( $id_annonce, Adherent $adherent, Lieu $lieu, $date_creation, $date_debut, $date_fin, Type $type, $cherche, $participation, $commentaire)
    {
    	$this->id_annonce = $id_annonce;
    	//$this->adherent = new Adherent();
        $this->adherent = $adherent;
        //$this->lieu = new Lieu();
        $this->lieu = $lieu;
    	$this->date_creation = $date_creation;
    	$this->date_debut = $date_debut;
    	$this->date_fin = $date_fin;
        //$this->type = new Type();
        $this->type = $type;
    	$this->cherche = $cherche;
    	$this->participation = $participation;
    	$this->commentaire = $commentaire;
    }
    
    public function getID() {
        return $this->id_annonce;        
    }
    
    public function setID($id){
        $this->id_annonce = (int) $id;
    }
    
    public function getAdherent() {
        return $this->adherent;        
    }
    
    public function setAdherent($adherent){
        $this->adherent = $adherent;
    }
    
    public function getLieu() {
        return $this->lieu;        
    }
    
    public function setLieu($lieu){
        $this->lieu = $lieu;
    }
    
    public function getDateCreation() {
        return $this->date_creation;        
    }
    
    public function setDateCreation($date){
        $this->date_creation = $date;
    }
    
    public function getDateDebut() {
        return $this->date_debut;        
    }
    
    public function setDateDebut($date){
        $this->date_debut = $date;
    }
    
    public function getDateFin() {
        return $this->date_fin;        
    }
    
    public function setDateFin($date){
        $this->date_fin = $date;
    }
    
    public function getType() {
        return $this->type;        
    }
    
    public function setType($type){
        $this->type = $type;
    }
    
    public function getCherche() {
        return (boolean)$this->cherche;        
    }
    
    public function setCherche($cherche){
        $this->cherche = $cherche;
    }
    
    public function getParticipation() {
        return $this->participation;        
    }
    
    public function setParticipation($participation){
        $this->participation = $participation;
    }
    
    public function getCommentaire() {
        return $this->commentaire;        
    }
    
    public function setCommentaire($commentaire){
        $this->commentaire = $commentaire;
    }
    
    public function isValid(){
        $date = date('Y-m-d');
        if ($date > $date_fin){
            return false;
        }
        else{
            return true;
        }
    }
}
?>