<?php
    require_once('Modele/Adherents/AdherentDAO.php');
    require_once('Modele/Adherents/Adherent.php');
    
    class ControllerAdherents{

        private $adherentDAO;

        public function __construct(){
            $this->adherentDAO = new AdherentDAO();
        }

        public function getByID( $id ){
            $adherent = $this->adherentDAO->getByID( $id );
            require_once('Vue/Profil/Adherent.php');
        }

        public function create(  ){
        	$password = md5($_POST['password']);
            $adherent = new Adherent( -1, $_POST['pseudo'], $password, $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['telephone'], $_POST['description'], $_POST['possede_bateau']);
            $adherentDAO->addAdherent($adherent);
            
            //require_once('Vue/Annonces/AnnonceVue.php');
            require_once('Vue/Login/ConnexionVue.php');

        }

        public function checkConnection(){
        	$pseudo = $_POST['pseudo'];
        	$password = $_POST['password'];
        	$id = $this->adherentDAO->getID($pseudo, $password);
        	if ( isset($id) && $id != -1 && $id !=''){
        		$adherent  = $this->adherentDAO->getByID($id);
        		if( isset($adherent) && $adherent->getPassword() == (md5($password)) && $pseudo == $adherent->getPseudo() ){
        			setcookie('pseudo',$pseudo,time()+3600*24*30);
        			setcookie('password', md5($password),time()+3600*24*30);
        			setcookie('id',$id,time()+3600*24*30);
        			require_once('accueil.php');
        		}
        	}
        }

        public function getAll()
        {
            // à  faire pour l'acces BD
            require_once('Vue/Annonces/AnnoncesVue.php');
        }
    }
?>
