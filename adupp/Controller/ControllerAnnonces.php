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
            require_once('Vue/Annonces/AnnoncesVue.php');
        }

        public function create( $adhérent, $lieuForm, $date_debut, $date_fin, $type, $cherche, $participation, $commentaire ){
            $type = new Type();
            $type = $this->typeDAO->getByName($type);
            $lieu = new Lieu();
            $lieu = $this->lieuDAO->getByName($lieuForm);
            $adherent = new Adherent();
            $adherent = $this->adherentDAO->getByID($_COOKIE['id_adherent']);
            $date_creation = date(y-m-d);

            $annonce = new Annonce( -1,
                $adhérent,
                $lieu,
                $date_creation, 
                $date_debut, 
                $date_fin, 
                $type, 
                $cherche,
                $participation,
                $commentaire );
            $annonceDAO->addAnnonce( $annonce);

            require_once('Vue/Annonces/AnnonceVue.php');

        }

        public function search(){
            $id_lieu = $this->lieuDAO->getID($_POST['lieu']);
            $id_type = $this->typeDAO->getID($_POST['type']);
            $participation = (boolean)$_POST['participation'];
            $cherche = (boolean)$_POST['cherche'];
            $annonces = $this->AnnonceDAO($id_lieu, $id_type, $participation, $cherche);
            require_once('Vue/AnnoncesVue.php');
        }

        public function getAll()
        {
            $annonces = $this->annonceDAO->getAll();
            require_once('Vue/Annonces/AnnoncesVue.php');
        }
    }
?>