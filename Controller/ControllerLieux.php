<?php
    require_once('Modele/Lieux/LieuDAO.php');
    require_once('Modele/Lieux/Lieu.php');
    
    class ControllerLieux{

        private $lieuDAO;

        public function __construct(){
            $this->lieuDAO = new LieuDAO();
        }

        public function getByID( $id ){
            $lieu = $this->lieuDAO->getByID( $id );
            require_once('');
        }

        public function create(  ){
        	$nom = $_POST['nom'];
            $lieu = new Liey( -1, $nom);
            $this->typeDAO->addLieu($lieu);
            require_once('');

        }

        public function getAll()
        {
            $lieux = $this->lieuDAO->getAll();
            return $lieux;
        }

        
    }
?>
