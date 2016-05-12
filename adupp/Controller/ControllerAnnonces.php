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
            $AnnonceDAO = new AnnonceDAO();
            $typeDAO = new TypeDAO();
            $lieuDAO = new LieuDAO();
            $adherentDAO = new AdherentDAO();
        }

        public function getByID( $id ){
            $annonce = new Annonce();
            $annonce = $annonceDAO->getByID( $id);
            require_once('Vue/Annonces/AnnonceVue.php');
        }

        public function create( $adhérent, $lieuForm, $date_debut, $date_fin, $type, $cherche, $participation, $commentaire ){
            $type = new Type();
            $type = $typeDAO->getByName($type);
            $lieu = new Lieu();
            $lieu = $lieuDAO->getByName($lieuForm);
            $adherent = new Adherent();
            $adherent = $adherentDAO.getByID($_COOKIE['id_adherent']);
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

        public function getAll()
        {
            // à  faire pour l'acces BD
            require_once('Vue/Annonces/AnnoncesVue.php');
        }
    }
?>