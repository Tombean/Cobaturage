<?php
class Type{
	private $id_type;
	private $nom;

	public function __construct( $id_type, $nom)
    {
    	$this->id_type = $id_type;
    	$this->nom = $nom;
	}

	public function getID() {
        return $this->id_type;        
    }
    
    public function setID($id){
        $this->id_type = (int) $id;
    }

    public function getNom() {
        return (string)$this->nom;        
    }
    
    public function setNom($nom){
        $this->nom = $nom;
    }
}

?>