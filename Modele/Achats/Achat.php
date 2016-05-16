<?php
class Achat{

	private $id_achat;
	private $adherent;
	private $prix;
	private $date_creation;
	private $vend;
	private $commentaire;
	
	public function __construct( $id_achat, Adherent $adherent, $prix, $date_creation, $vend, $commentaire)
    {
    	$this->id_achat = $id_achat;
        $this->adherent = $adherent;
        $this->prix = $prix;
    	$this->date_creation = $date_creation;
    	$this->vend = (boolean)$vend;
    	$this->commentaire = $commentaire;
    }

    public function getID() {
        return $this->id_achat;        
    }
    
    public function setID($id){
        $this->id_achat = (int) $id;
    }

    public function getAdherent() {
        return $this->adherent;        
    }
    
    public function setAdherent($adherent){
        $this->adherent = $adherent;
    }

     public function getDateCreation() {
        return $this->date_creation;        
    }
    
    public function setDateCreation($date){
        $this->date_creation = $date;
    }

    public function getPrix() {
        return $this->prix;        
    }
    
    public function setPrix($prix){
        $this->prix = $prix;
    }

    public function getVend() {
        return $this->vend;        
    }
    
    public function setVend($vend){
        $this->vend = $vend;
    }

    public function getCommentaire() {
        return $this->commentaire;        
    }
    
    public function setCommentaire($commentaire){
        $this->commentaire = $commentaire;
    }
}

?>