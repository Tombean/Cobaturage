<?php
    require_once('Modele/Adherents/AdherentDAO.php');
    require_once('Modele/Adherents/Adherent.php');
    
    class ControllerAdherents{

        private $adherentDAO;

        public function __construct(){
            $this->adherentDAO = new AdherentDAO();
        }

        public function getByID( $id_adherent ){
            $adherent = $this->adherentDAO->getByID( $id_adherent );
            require_once('Vue/Profil/AdherentVue.php');
        }

        /*public function create(  ){
        	$password = md5($_POST['password']);
            $adherent = new Adherent( -1, $_POST['pseudo'], $password, $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['telephone'], $_POST['description'], $_POST['possede_bateau']);
            $this->adherentDAO->addAdherent($adherent);
            require_once('Vue/Login/ConnexionVue.php');

        } */

        public function checkConnection(){
        	$pseudo = strtolower($_POST['pseudo']);
        	$password = md5($_POST['password']);
        	$id = $this->adherentDAO->getID($pseudo, $password);
        	if ( isset($id) && $id != -1 && $id !=''){
        		$adherent  = $this->adherentDAO->getByID($id);
        		if( isset($adherent) && $adherent->getPassword() == $password && $pseudo == $adherent->getPseudo() ){
                    setcookie('pseudo',''+3600*24*30, "/adupp/");
                    setcookie('password', '',time()+3600*24*30, "/adupp/");
                    setcookie('id','',time()+3600*24*30, "/adupp/");
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
            $adherents = $this->adherentDAO->getAll();

            require_once('Vue/Profil/AdherentsVue.php');
        }

        public function add(){
        	setcookie('DANS_LE_ADD','TRUE',time()+3600*24*30);
        	$pseudo = strtolower($_POST['pseudo']);
        	$prenom = $_POST['prenom'];
        	$nom = $_POST['nom'];
        	$password = $_POST['password'];
        	$password_verif = $_POST['password_verif'];
        	$email = $_POST['email'];
        	$telephone = $_POST['telephone'];
        	$possede_bateau = $_POST['possede_bateau'];
        	$description = $_POST['description'];
        	$admin = false;
        	$id = -1;
        	if( $password != $password_verif){
        		$erreur = "Vous avez entré une confirmation de mot de passe érronée, merci de recommencer votre inscription ( bouton Connexion puis bouton Pas encore inscrit(e). ";
        		require_once('Vue/Erreur.php');
        	}
        	else{
        		if( (isset($pseudo) || $pseudo !='' )
        			&& ( isset($prenom) || $prenom !='' )
        			&& ( isset($nom) || $nom !='' )
        			&& ( isset($password) || $password !='' )
        			&& ( isset($email) || $email !='' )
        			&& ( isset($telephone) || $telephone !='' )){
        			$adherent = new Adherent ( $id, $pseudo, md5($password), $nom, $prenom, $email, $telephone, $description, $possede_bateau, $admin);
        			$this->adherentDAO->addAdherent($adherent);
        			$message = "Bienvenue à toi ".$pseudo." ! Tu as bien été inscrit(e).";
                    setcookie('pseudo',''+3600*24*30, "/adupp/");
                    setcookie('password', '',time()+3600*24*30, "/adupp/");
                    setcookie('id','',time()+3600*24*30, "/adupp/");
                    setcookie('pseudo',$pseudo,time()+3600*24*30, "/adupp/");
                    setcookie('password', md5($password),time()+3600*24*30, "/adupp/");
                    setcookie('id',$id,time()+3600*24*30, "/adupp/");
        			require_once("Vue/Message.php");
        		}

        	}
        }
    }
?>
