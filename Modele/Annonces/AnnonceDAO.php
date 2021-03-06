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
            $this->bd = new PDO('XXXXXXX', 'XXXXXXX', 'XXXXXXX', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->typeDAO = new TypeDAO();
            $this->lieuDAO = new LieuDAO();
            $this->adherentDAO = new AdherentDAO();

        }
        
        /** This function will get the lasts X ( param ) Annonce from the data base
         *  and will order them by creation date in order to have a chronological order
         * @param  Integer number of how many Annonce should be fetched
         * @return X last Annonces
         */
        public function last($limite)
        {
            
            $annoncesTab = array();
            $req = $this->bd->prepare('SELECT * FROM Annonces 
                WHERE date_fin > CURDATE()
                ORDER BY date_fin DESC
                LIMIT :limite');
            $req->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
            $req->execute();
            $result = $req->fetchAll();
            for( $i = 0; $i< $limite; $i++){

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

       /**  Deletes an Annonce in the database based on its given ID
         * @param  Integer :  the Annonce's ID
         */
        public function deleteByID($id_annonce)
        {
            $req = $this->bd->prepare('DELETE 
                FROM Annonces 
                WHERE id_annonce = :id');
            $req->bindParam(':id', $id_annonce );
            $req->execute();
        }


        
        public function addAnnonce(Annonce $annonce)
        {
            $req = $this->bd->prepare('INSERT INTO Annonces
                (adherent, date_creation, date_debut, date_fin, type, cherche, participation, commentaire, lieu)
                VALUES(:adherent, :date_creation, :date_debut, :date_fin, :type, :recherche, :participation, :commentaire, :lieu)
                ');
            $date_creation = date_format($annonce->getDateCreation(), 'Y-m-d');
            $req->bindParam(':date_creation', $date_creation );
            $req->bindParam(':date_debut', $annonce->getDateDebut() );
            $req->bindParam(':date_fin', $annonce->getDateFin() );
            $req->bindParam(':type', $annonce->getType()->getID() );
            $req->bindParam(':recherche', $annonce->getCherche() );
            $req->bindParam(':participation', $annonce->getParticipation() );
            $id_adherent = $annonce->getAdherent()->getID();
            $req->bindParam(':adherent', $id_adherent );
            $req->bindParam(':commentaire', $annonce->getCommentaire() );
            $req->bindParam(':lieu', $annonce->getLieu()->getID() );
            $req->execute();
            $id = $this->bd -> lastInsertId();
            $annonce->setID($id);

        }


        /** Will get all Annonces from the database that are currently valid and are from a given Adherent
         * @param  Adherent Object
         * @return array of Annonce
         */
        public function getAllFor(Adherent $adherent)
        {   
            $annoncesTab = array();
            $req = $this->bd->prepare('SELECT *  
                FROM Annonces 
                WHERE adherent = :id_adherent
                AND date_fin > CURDATE()
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
            if ($annonce->getID() >= 0){
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
                WHERE date_fin > CURDATE()
                ORDER BY date_fin DESC;');
            //$now = date(y-m-d);
            //$req->bindParam(':now', $now );
            $req->execute();
            $results = $req->fetchAll();
            $i = 0;
            foreach($results as $result){

                $lieu = new Lieu();
                $lieu = $this->lieuDAO->getByID($result['lieu']);
                $type = new Type();
                $type = $this->typeDAO->getByID($result['type']);
                $adherent = new Adherent();
                $adherent = $this->adherentDAO->getByID($result['adherent']);;


                $annonceFromReq = new Annonce($result['id_annonce'], $adherent, $lieu, $result['date_creation'], $result['date_debut'],
                    $result['date_fin'], $type, $result['cherche'], $result['participation'], $result['commentaire'], false);
                
                $annoncesTab[$i] = $annonceFromReq;
                $i++;

            }

            return $annoncesTab;
        }
    }
?>