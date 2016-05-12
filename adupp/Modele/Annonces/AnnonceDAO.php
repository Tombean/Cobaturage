<?php
    require_once('Modele/Annonces/Annonce.php');
    require_once('Modele/Adherents/Adherent.php');
    require_once('Modele/Lieux/Lieu.php');
    require_once('Modele/Lieux/LieuDAO.php');
    require_once('Modele/Types/Type.php');
    require_once('Modele/Types/TypeDAO.php');
    require_once('Modele/Adherents/AdherentDAO.php');
    
    class AnnonceDAO{
        
        private $bd;
        private $typeDAO;
        private $lieuDao;
        private $adherentDAO;

        public function __construct(){
            $this->bd = new PDO('mysql:host=db626009884.db.1and1.com;dbname=db626009884;charset=utf8', 'dbo626009884', 'Polytech7', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->typeDAO = new TypeDAO();
            $this->lieuDAO = new LieuDAO();
            $this->adherentDAO = new AdherentDAO();

        }
        
        /** This function will get the lasts X ( param ) Annonce from the data base
         *  and will order them by creation date in order to have a chronological order
         * @param  Integer number of how many Annonce should be fetched
         * @return X last Annonces
         */
        public function last($X)
        {
            
            $limit = (int) $X;
            $annoncesTab = array();
                
            $req = $this->bd->prepare('SELECT Lieux.nom AS lieu 
            	DATE_FORMAT(Annonces.date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation, 
            	DATE_FORMAT(Annonces.date_debut, \'%d/%m/%Y à %Hh%imin%ss\') AS debut, 
            	DATE_FORMAT(Annonces.date_fin, \'%d/%m/%Y à %Hh%imin%ss\') AS fin, 
            	Types.nom AS type,
            	Annonces.recherche AS recherche,
            	Annonces.participation AS participation,
            	FROM Annonces JOIN Lieux ON Annonces.lieu = Lieux.id_lieu JOIN Types ON Annonces.type = Types.id_type
            	ORDER BY date_creation LIMIT :limit');
            $req->bindParam(':limit', $limit, PDO::PARAM_INT);
            $req->execute();
            $result = $req->fetchAll();
            for( $i = 0; $i< $X; $i++){

                $adherent = new Adherent();
                $adherent = $this->adherentDAO->getByID($result[$i]['adherent']);
                $lieu = new Lieu();
                $lieu = $this->lieuDAO->getByID($result[$i]['lieu']);
                $type = new Type();
                $type = $this->typeDAO->getByID($result[$i]['type']);


                $annonceFromReq = new Annonce($result[$i]['id_annonce'], $adherent, $lieu, $result[$i]['date_creation'], $result[$i]['date_debut'],
                    $result[$i]['date_fin'], $type, $result[$i]['cherche'], $result[$i]['participation'], $result[$i]['commentaire']);
                
                $annoncesTab[$i] = $annonceFromReq;

            }
            
            
            return $annoncesTab;
        }


        /** Uses a Annonce's ID to get the Annonce
         * @param  Annonce's ID
         * @return Annonce
         */
        public function getByID($id)
        {
                
            $req = $this->bd->prepare('SELECT * 
                FROM Annonces 
                WHERE id_annonce = :id');
            $req->bindParam(':id', $id );
            $req->execute();

            $result = $req->fetchAll();

            $adherent = new Adherent();
            $adherent = $this->adherentDAO->getByID($result[0]['adherent']);
            $lieu = new Lieu();
            $lieu = $this->lieuDAO->getByID($result[0]['lieu']);
            $type = new Type();
            $type = $this->typeDAO->getByID($result[0]['type']);


            $annonceFromReq = new Annonce($result[0]['id_annonce'], $adherent, $lieu, $result[0]['date_creation'], $result[0]['date_debut'],
                $result[0]['date_fin'], $type, $result[0]['cherche'], $result[0]['participation'], $result[0]['commentaire']);
            
            
            return $annonceFromReq;
        }


        /** Deletes an Annonce in the database based on a given Annonce object
         * This function will get the Annonce's ID use it to delete the right annonce
         * @param  Annonce Object
         * @return nothing
         */
       
        public function deleteByID($annonce)
        {
            $id = $annonce->getID();
            $req = $this->bd->prepare('DELETE 
                FROM Annonces 
                WHERE id_annonce = :id');
            $req->bindParam(':id', $id );
            $req->execute();
        }


        /**  Deletes an Annonce in the database based on its given ID
         * @param  Integer :  the Annonce's ID
         */
        public function addAnnonce($annonce)
        {
            $req = $this->bd->prepare('INSERT INTO Annonces
                (adherent, date_creation, date_debut, date_fin, type, recherche, participation, commentaire, lieu)
                VALUES(:adherent, :date_creation, :date_debut, :date_fin, :type, :recherche, :participation, :commentaire, :lieu)
                ');
            $req->bindParam(':date_creation', $annonce->getDateCreation() );
            $req->bindParam(':date_debut', $annonce->getDateDebut() );
            $req->bindParam(':date_fin', $annonce->getDateFin() );
            $req->bindParam(':type', $annonce->getType()->getID() );
            $req->bindParam(':recherche', $annonce->getRecherche() );
            $req->bindParam(':participation', $annonce->getParticipation() );
            $req->bindParam(':adherent', $annonce->getAdherent()->getID() );
            $req->bindParam(':commentaire', $annonce->getCommentaire() );
            $req->bindParam(':lieu', $annonce->getLieu()->getID() );
            $req->execute();
            $id = $this->bd -> lastInsertId();
            $annonce->setID($id);

        }


        /** Will get all Annonces from the database that are currently valid and are from a given Adherent
         * @param  url  an absolute URL giving the base location of the image
         * @return 
         */
        public function getAllFor($adherent)
        {
            $annoncesTab = array();
            $req = $this->bd->prepare('SELECT *  
                FROM Annonces 
                WHERE id_adherent = :id_adherent
                ORDER BY date_creation');
            $req->bindParam(':id_adherent', $adherent->getID() );
            $req->execute();
            $result = $req->fetchAll();
            
            $i = 0;
             while( isset($result[$i]) ){

                $lieu = new Lieu();
                $lieu = $this->lieuDAO->getByID($result[$i]['lieu']);
                $type = new Type();
                $type = $this->typeDAO->getByID($result[$i]['type']);


                $annonceFromReq = new Annonce($result[$i]['id_annonce'], $adherent, $lieu, $result[$i]['date_creation'], $result[$i]['date_debut'],
                    $result[$i]['date_fin'], $type, $result[$i]['cherche'], $result[$i]['participation'], $result[$i]['commentaire']);
                
                $annoncesTab[$i] = $annonceFromReq;
                $i = $i + 1;

            }
            

            return $annoncesTab;
        }
        
        public function edit($annonce)
        {
            if ($annonce.getID() >= 0){
                $req = $this->bd->prepare('UPDATE Annonces
                SET adherent = :adherent,
                date_creation = :date_creation,
                date_debut = :date_debut,
                date_fin = :date_fin,
                type = :type,
                recherche = :recherche,
                participation = :participation,
                commentaire = :commentaire,
                WHERE id_annonce = :id');
                $req->bindParam(':date_creation', $annonce->getDateCreation() );
                $req->bindParam(':date_debut', $annonce->getDateDebut() );
                $req->bindParam(':date_fin', $annonce->getDateFin() );
                $req->bindParam(':type', $annonce->getType()->getID() );
                $req->bindParam(':recherche', $annonce->getRecherche() );
                $req->bindParam(':participation', $annonce->getParticipation() );
                $req->bindParam(':adherent', $annonce->getAdherent()->getID() );
                $req->bindParam(':commentaire', $annonce->getCommentaire() );
                $req->bindParam(':id', $annonce->getID() );
                $req->execute();

            }
        }
        

        public function search($recherche)
        {
            $requete = 'SELECT *  FROM Annonces ';  
            $compteur = 0;
            $annoncesTab = array();
            //gerer les jointures !!!!!!
            foreach ($recherche as $cle => $valeur){
                if($valeur != null ){
                    $compteur++;
                    if($compteur == 1){
                        $requete .='WHERE ';
                    }
                    else if($compteur > 1){
                        $requete .=' AND ';
                    }  
                    $requete .=$cle.' = '.$valeur;
                }
            }
            $requete +=';';
            $req = $this->bd->prepare($requete);
            $req->execute();
            $result = $req->fetchAll();

            $i = 0;
             while( isset($result[$i]) ){

                $adherent = new Adherent();
                $adherent = $this->adherentDAO->getByID($result[$i]['adherent']);
                $lieu = new Lieu();
                $lieu = $this->lieuDAO->getByID($result[$i]['lieu']);
                $type = new Type();
                $type = $this->typeDAO->getByID($result[$i]['type']);


                $annonceFromReq = new Annonce($result[$i]['id_annonce'], $adherent, $lieu, $result[$i]['date_creation'], $result[$i]['date_debut'],
                    $result[$i]['date_fin'], $type, $result[$i]['cherche'], $result[$i]['participation'], $result[$i]['commentaire']);
                
                $annoncesTab[$i] = $annonceFromReq;
                $i = $i + 1;

            }

            return $annoncesTab;
        }

        public function getAll(){
            $annoncesTab = array();
            $req = $this->bd->prepare('SELECT * FROM Annonces 
                WHERE date_fin < :now');
            $now = date(y-m-d);
            $req->bindParam(':now', $now );
            $result = $req->fetchAll();
            
            $i = 0;
             while( isset($result[$i]) ){

                $lieu = new Lieu();
                $lieu = $this->lieuDAO->getByID($result[$i]['lieu']);
                $type = new Type();
                $type = $this->typeDAO->getByID($result[$i]['type']);


                $annonceFromReq = new Annonce($result[$i]['id_annonce'], $adherent, $lieu, $result[$i]['date_creation'], $result[$i]['date_debut'],
                    $result[$i]['date_fin'], $type, $result[$i]['cherche'], $result[$i]['participation'], $result[$i]['commentaire']);
                
                $annoncesTab[$i] = $annonceFromReq;
                $i = $i + 1;

            }

            return $annoncesTab;
        }
    }
?>