<?php
require_once('../Profil/Adherent.php');
require_once('../Annonce/Annonce.php');
class Demandes
{
        private $annonce;
	private $adherent;
	private $date_debut;
	private $date_fin;
	private $commentaire;
        
        
        public function __construct( $annonce, $adherent, $date_debut, $date_fin, $commentaire)
    {
    	$this->annonce = $annonce;
	$this->adherent = $adherent;
	$this->date_debut = $date_debut;
	$this->date_fin = $date_fin;
	$this->commentaire = $commentaire;
    }
    
    public function getAdherent() {
        return $this->adherent;        
    }
    
    public function setAdherent($adherent){
        $this->adherent = $adherent;
    }
    
    public function getAnnonce() {
        return $this->annonce;        
    }
    
    public function setAnnonce($annonce){
        $this->annonce = $annonce;
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