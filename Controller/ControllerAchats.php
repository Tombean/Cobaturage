<?php
    require_once('Modele/Achats/Achat.php');
    require_once('Modele/Achats/AchatDAO.php');
    require_once('Modele/Adherents/AdherentDAO.php');
    require_once('Modele/Adherents/Adherent.php');
    
    class ControllerAchats{

        private $achatDAO;
        private $adherentDAO;

        public function __construct(){
            $this->achatDAO = new AchatDAO();
            $this->adherentDAO = new AdherentDAO();
        }

        public function getByID( $id_achat ){
            $achat = $this->achatDAO->getByID( $id_achat );
            $mise_en_contact = true;
            $message1 = "Voici l'annonce que vous cherchiez";
            $message2 = "";
            $mise_en_contact = true;
            require_once('Vue/Achats/AchatVue.php');
        }

        public function deleteByID( $id_achat ){
            $achat = $this->achatDAO->getByID( intval($id_achat) );
            if ( $achat->getAdherent()->getID() == intval($_COOKIE['id']) ){
                $this->achatDAO->deleteByID( $id_achat );
                $this->getAllFor();
            }
            else{
                $erreur = "Vous ne pouvez supprimer que vos annonces. Merci de n'accéder à la fonction de suppression qu'uniquement à travers le menu \"Mes achats \\ ventes\" et non par l'URL.";
                require_once 'Vue/Erreur.php';
            }
        }

        public function create($prix, $vend, $commentaire ){
            $adherent = new Adherent();
            $adherent = $this->adherentDAO->getByID($_COOKIE['id']);
            $date_creation = new DateTime();
            $achat = new Achat( -1,
                $adherent,
                $prix,
                $date_creation,  
                (boolean)$vend,
                $commentaire );
            $this->achatDAO->addAchat( $achat);
            $mise_en_contact = false;
            require_once('Vue/Achats/MesAchatsVue.php');
        }

        public function getAll(){
            $achats = $this->achatDAO->getAll();
            $pluriel = 'achat / vente';
            if(count($achats) > 1 ){ $pluriel ='achats / ventes';}
            $message1 = 'Consultez en descendant les annonces du site';
            $message2 = '<h3>'.count($achats).' '.$pluriel.' sur le site : </h3><br>';
            $mise_en_contact = true;
            $adherent_admin = false;
            $id_adherent = intval($_COOKIE['id']);
            
            if( $_COOKIE['id']=! null || isset($_COOKIE['id']) || $_COOKIE['id'] !=""){
                $adherent_admin = $this->adherentDAO->getByID( $id_adherent )->getAdmin();
            }

            require_once 'Vue/Achats/AchatsVue.php';
        }

        public function getAllFor(){
            $adherent = new Adherent();
            $adherent = $this->adherentDAO->getByID($_COOKIE['id']);
            $achats = $this->achatDAO->getAllFor($adherent);
            $message1 = 'Vos achats/ventes en ligne';
            $pluriel = 'achat / vente';
            if(count($achats) > 1 ){ $pluriel ='achats / ventes';}
            $message2 = '<h3>Vous avez '.count($achats).' '.$pluriel.' sur le site : </h3><br>';
            $mise_en_contact = False;
            require_once('Vue/Achats/MesAchatsVue.php');

        }
        /*
        public function deleteByID( $id_achat ){
            $achat = $this->achat->getByID( intval($id_achat) );
            $adherent_admin = $this->adherentDAO->getByID( $_COOKIE['id'] )->getAdmin();
            if ( ($achat->getAdherent()->getID() == intval($_COOKIE['id']) ) || $adherent_admin ){
                $this->achatDAO->deleteByID( $id_achat );
                $this->getAllFor();
            }
            else{
                $erreur = "Vous ne pouvez supprimer que vos achats/ventes. Merci de n'accéder à la fonction de suppression qu'uniquement à travers le menu \"Mes achats / ventes\" et non par l'URL.";
                require_once 'Vue/Erreur.php';
            }
        } */
    }
?>