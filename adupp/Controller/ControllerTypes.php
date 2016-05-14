<?php
    require_once('Modele/Types/TypeDAO.php');
    require_once('Modele/Types/Type.php');
    
    class ControllerTypes{

        private $typeDAO;

        public function __construct(){
            $this->typeDAO = new TypeDAO();
        }

        public function getByID( $id ){
            $adherent = $this->typeDAO->getByID( $id );
            require_once('');
        }

        public function create(  ){
        	$nom = $_POST['nom'];
            $type = new Type( -1, $nom);
            $this->typeDAO->addTypes($type);
            require_once('');

        }

        public function getAll()
        {
            $types = $this->typeDAO->getAll();
            return $types;
        }

        
    }
?>
