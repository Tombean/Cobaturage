<?php
class Lieu{
	private $id_lieu;
	private $nom;

	public function __construct( $id_lieu, $nom)
    {
    	$this->id_lieu = (int)$id_lieu;
    	$this->nom = (string)$nom;
	}

	public function getID() {
        return (int)$this->id_lieu;        
    }
    
    public function setID($id){
        $this->id_lieu = (int) $id;
    }

    public function getNom() {
        return (string)$this->nom;        
    }
    
    public function setNom($nom){
        $this->nom = (string)$nom;
    }
}

?>