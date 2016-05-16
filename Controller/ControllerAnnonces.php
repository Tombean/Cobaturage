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

        public function getByID( $id_annonce ){
            $annonce = $this->annonceDAO->getByID( $id_annonce );
            $mise_en_contact = true;
            require_once('Vue/Annonces/AnnonceVue.php');
        }

        public function deleteByID( $id_annonce ){
            $annonce = $this->annonceDAO->getByID( intval($id_annonce) );
            $adherent_admin = $this->adherentDAO->getByID( $_COOKIE['id'] )->getAdmin();
            if ( ($annonce->getAdherent()->getID() == intval($_COOKIE['id']) ) || $adherent_admin ){
                $this->annonceDAO->deleteByID( $id_annonce );
                $this->getAllFor();
            }
            else{
                $erreur = "Vous ne pouvez supprimer que vos annonces. Merci de n'accéder à la fonction de suppression qu'uniquement à travers le menu \"Mes annonces\" et non par l'URL.";
                require_once 'Vue/Erreur.php';
            }
        }

        public function last( $limit ){
            $annonces = $this->annonceDAO->last($limit);
            $message1 = 'Voici l\'ensemble des '.count($annonces).' dernières annonces à jour du site';
            $message2 = '<h3>Légende :</h3><br>';
            $mise_en_contact = true;
            require_once('Vue/Annonces/AnnoncesVue.php');
        }

        public function create( $id_lieu, $date_debut, $date_fin, $id_type, $cherche, $participation, $commentaire ){
            $type = new Type();
            $type = $this->typeDAO->getByID($id_type);
            $lieu = new Lieu();
            $lieu = $this->lieuDAO->getByID($id_lieu);
            $adherent = new Adherent();
            $adherent = $this->adherentDAO->getByID($_COOKIE['id']);
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
            $mise_en_contact = false;
            require_once('Vue/Annonces/AnnoncesVue.php');

        }

        public function search(){
            $id_lieu = $this->lieuDAO->getID($_POST['lieu']);
            $id_type = $this->typeDAO->getID($_POST['type']);
            $participation = (boolean)$_POST['participation'];
            $cherche = (boolean)$_POST['cherche'];
            $annonces = $this->AnnonceDAO($id_lieu, $id_type, $participation, $cherche);
            $pluriel = 'annonce';
            if(count($annonces) > 1 ){ $pluriel .='s';}
            $message1 = 'Voici l\'ensemble des annonces correspondant à votre recherche';
            $message2 = '<h3>'.count($annonces).' '.$pluriel.' correspondantes : </h3><br>';
            $mise_en_contact = true;
            require_once('Vue/AnnoncesVue.php');
        }

        public function getAll()
        {
            $annonces = $this->annonceDAO->getAll();
            $pluriel = 'annonce';
            if(count($annonces) > 1 ){ $pluriel .='s';}
            $message1 = 'Découvrez les annonces du site';
            $message2 = '<h3>'.count($annonces).' '.$pluriel.' sur le site : </h3><br>';
            $mise_en_contact = true;
            $adherent_admin = false;
            $id_adherent = intval($_COOKIE['id']);
            
            if( $_COOKIE['id']=! null || isset($_COOKIE['id']) || $_COOKIE['id'] !=""){
                $adherent_admin = $this->adherentDAO->getByID( $id_adherent )->getAdmin();
            }

            require_once 'Vue/Annonces/AnnoncesVue.php';
        }

        public function getAllFor(){
            $adherent = new Adherent();
            $adherent = $this->adherentDAO->getByID($_COOKIE['id']);
            $annonces = $this->annonceDAO->getAllFor($adherent);
            $message1 = 'Vos annonces en ligne';
            $pluriel = 'annonce';
            if(count($annonces) > 1 ){ $pluriel .='s';}
            $message2 = '<h3>Vous avez '.count($annonces).' '.$pluriel.' sur le site : </h3><br>';
            $mise_en_contact = False;
            require_once('Vue/Annonces/AnnoncesVue.php');

        }
    }
?>