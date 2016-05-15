<?php
    require_once('Modele/Annonces/Annonce.php');
    require_once('Modele/Annonces/AnnonceDAO.php');
    require_once('Modele/Lieux/Lieu.php');
    require_once('Modele/Lieux/LieuDAO.php');
    require_once('Modele/Types/Type.php');
    require_once('Modele/Types/TypeDAO.php');
    require_once('Modele/Adherents/AdherentDAO.php');
    require_once('Modele/Adherents/Adherent.php');
    
    class ControllerAnnonces{

        private $annonceDAO;
        private $typeDAO;
        private $lieuDao;
        private $adherentDAO;

        public function __construct(){
            $this->annonceDAO = new AnnonceDAO();
            $this->typeDAO = new TypeDAO();
            $this->lieuDAO = new LieuDAO();
            $this->adherentDAO = new AdherentDAO();
        }

        public function getByID( $id ){
            $annonce = $this->annonceDAO->getByID( $id );
            require_once('Vue/Annonces/AnnonceVue.php');
        }

        public function last( $limit ){
            $annonces = $this->annonceDAO->last($limit);
            $message1 = 'Voici l\'ensemble des '.count($annonces).' dernières annonces à jour du site !';
            $message2 = '<h3>En bleu les recherches et en blanc les propositions : </h3><br>';
            require_once('Vue/Annonces/AnnoncesVue.php');
        }

        public function create( $id_lieu, $date_debut, $date_fin, $id_type, $cherche, $participation, $commentaire ){
            $type = new Type();
            $type = $this->typeDAO->getByID($id_type);
            $lieu = new Lieu();
            $lieu = $this->lieuDAO->getByID($id_lieu);
            $adherent = new Adherent();
            $adherent = $this->adherentDAO->getByID($_COOKIE['id']);
            //$date_creation = date('Y-m-d H:i:s');
            //$message = date_format($date_creation, 'Y-m-d H:i:s');
            //$message = gettype($adherent);
            require_once ('Vue/Message.php');
            $date_creation = new DateTime();
            $annonce = new Annonce( -1,
                $adherent,
                $lieu,
                $date_creation, 
                $date_debut, 
                $date_fin, 
                $type, 
                (boolean)$cherche,
                (boolean)$participation,
                $commentaire );
            $this->annonceDAO->addAnnonce( $annonce);

            require_once('Vue/Annonces/AnnonceVue.php');

        }

        public function search(){
            $id_lieu = $this->lieuDAO->getID($_POST['lieu']);
            $id_type = $this->typeDAO->getID($_POST['type']);
            $participation = (boolean)$_POST['participation'];
            $cherche = (boolean)$_POST['cherche'];
            $annonces = $this->AnnonceDAO($id_lieu, $id_type, $participation, $cherche);
            $pluriel = 'annonce';
            if(count($annonces) > 1 ){ $pluriel .='s';}
            $message1 = 'Voici l\'ensemble des annonces correspondant à votre recherche!';
            $message2 = '<h3>Il y a '.count($annonces).' '.$pluriel.' correspondantes, les voici : en bleu les recherches et en blanc les propositions : </h3><br>';
            require_once('Vue/AnnoncesVue.php');
        }

        public function getAll()
        {
            $annonces = $this->annonceDAO->getAll();
            $pluriel = 'annonce';
            if(count($annonces) > 1 ){ $pluriel .='s';}
            $message1 = 'Voici l\'ensemble des annonces à jour du site !';
            $message2 = '<h3>Il y a '.count($annonces).' '.$pluriel.' sur le site, les voici : en bleu les recherches et en blanc les propositions : </h3><br>';
            require_once('Vue/Annonces/AnnoncesVue.php');
        }

        public function getAllFor(){
            $adherent = new Adherent();
            $adherent = $this->adherentDAO->getByID($_COOKIE['id']);
            $annonces = $this->annonceDAO->getAllFor($adherent);
            $message1 = 'Voici l\'ensemble de vos annonces à jour sur le site !';
            $pluriel = 'annonce';
            if(count($annonces) > 1 ){ $pluriel .='s';}
            $message2 = '<h3>Vous avez '.count($annonces).' '.$pluriel.' sur le site : en bleu vos recherches et en blanc vos propositions : </h3><br>';
            require_once('Vue/Annonces/AnnoncesVue.php');

        }
    }
?>