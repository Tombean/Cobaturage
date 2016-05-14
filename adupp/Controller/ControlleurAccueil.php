<?php
    require_once('Modele/Types/TypeDAO.php');
    require_once('Modele/Types/Type.php');
    require_once('Modele/Lieux/LieuDAO.php');
    require_once('Modele/Lieux/Lieu.php');
    
    class ControllerAdherents{

        private $typeDAO;

        public function __construct(){
            $this->typeDAO = new TypeDAO();
        }

        public function getByID( $id ){
            $adherent = $this->adherentDAO->getByID( $id );
            require_once('');
        }

        public function create(  ){
        	$nom = $_POST['nom'];
            $type = new Type( -1, $nom);
            $this->typeDAO->addTypes($type);
            require_once('');

        }

        public function checkConnection(){
        	$pseudo = strtolower($_POST['pseudo']);
        	$password = md5($_POST['password']);
        	$id = $this->adherentDAO->getID($pseudo, $password);
        	if ( isset($id) && $id != -1 && $id !=''){
        		$adherent  = $this->adherentDAO->getByID($id);
        		if( isset($adherent) && $adherent->getPassword() == $password && $pseudo == $adherent->getPseudo() ){
        			setcookie('pseudo',$pseudo,time()+3600*24*30, "/adupp/");
        			setcookie('password', md5($password),time()+3600*24*30, "/adupp/");
        			setcookie('id',$id,time()+3600*24*30, "/adupp/");
        			$message = "Vous voilà connecté(e) ".$pseudo;
        			require_once('Vue/Message.php');
        		}
        	}
        }

        public function getAll()
        {
            $types = $this->typeDAO->getAll();

            require_once('Vue/Profil/AdherentsVue.php');
        }

        
    }
?>
