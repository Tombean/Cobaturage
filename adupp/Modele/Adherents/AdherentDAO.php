<?php

    require_once('Modele/Adherents/Adherent.php');
    
    class AdherentDAO{
        
        private $bd;
        
        public function __construct(){
            $this->bd = new PDO('mysql:host=db626009884.db.1and1.com;dbname=db626009884;charset=utf8', 'dbo626009884', 'Polytech7', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }

        
        /** Uses a Adherent's ID to get the Adherent
         * @param  Adherent's ID
         * @return Adherent
         */
        public function getByID($id)
        {
                
            $req = $this->bd->prepare('SELECT * 
                FROM Adherents 
                WHERE id_adherent = :id');
            $req->bindParam(':id', $id );
            $req->execute();
            $result = $req->fetchAll();
            $adherentFromReq = new Adherent($result[0]['id_adherent'], $result[0]['pseudo'], $result[0]['password'], $result[0]['nom'], $result[0]['prenom'], $result[0]['email'], $result[0]['telephone'], $result[0]['description'], $result[0]['possede_bateau'] );
            
            return $adherentFromReq;
        }

        /** Uses a Adherent to get the Adherent
         * @param  Adherent
         * @return Adherent's ID
         */
        public function getID($pseudo, $pass)
        {
                
            $req = $this->bd->prepare('SELECT id_adherent 
                FROM Adherents 
                WHERE pseudo = :pseudo
                AND password = :password; ');
            $password = md5($pass);
            $req->bindParam(':pseudo', $pseudo );
            $req->bindParam(':password', $password );
            $req->execute();
            $result = $req->fetchAll();
            
            return $result;
        }


        /** Deletes an Annonce in the database based on a given Annonce object
         * This function will get the Annonce's ID use it to delete the right annonce
         * @param  Annonce Object
         * @return nothing
         */
       
        public function deleteByID($adherent)
        {
            $id = $adherent->getID();
            $req = $this->bd->prepare('DELETE 
                FROM Adherents 
                WHERE id_adherent = :id');
            $req->bindParam(':id', $id );
            $req->execute();
        }


        /**  Adds an adherent in the database based on an Adherent Object
         * @param  Integer :  the adherent's ID
         */
        public function addAdherent($adherent)
        {
            $req = $this->bd->prepare('INSERT INTO Adherents
                (pseudo, password, nom, prenom, email, telephone, description, possede_bateau)
                VALUES(:adherent, :pseudo, :nom, :prenom, :email,  :recherche, :telephone, :description, :possede_bateau)
                ');
            $req->bindParam(':pseudo', $annonce->getPseudo() );
            $req->bindParam(':password', $annonce->getPassword() );
            $req->bindParam(':nom', $annonce->getNom() );
            $req->bindParam(':prenom', $annonce->getPrenom() );
            $req->bindParam(':email', $annonce->getEmail() );
            $req->bindParam(':telephone', $annonce->getTelephone() );
            $req->bindParam(':adherent', $annonce->getAdherent()->getID() );
            $req->bindParam(':description', $annonce->getDescription() );
            $req->binDParam(':possede_bateau', $annonce->getPossedeBateau() );
            $req->execute();
            $id = $this->bd -> lastInsertId();
            $adherent->setID($id);

        }

        /*
        public function edit($adherent)
        {
            if ($annonce.getID() >= 0){
                $req = $this->bd->prepare('UPDATE Adherent
                SET adherent = :adherent,
                date_creation = :date_creation,
                date_debut = :date_debut,
                date_fin = :date_fin,
                type = :type,
                recherche = :recherche,
                participation = :participation,
                commentaire = :commentaire,
                WHERE id_annonce = :id');
                 $req->bindParam(':pseudo', $annonce->getPseudo() );
                $req->bindParam(':password', $annonce->getPassword() );
                $req->bindParam(':nom', $annonce->getNom() );
                $req->bindParam(':prenom', $annonce->getPrenom() );
                $req->bindParam(':email', $annonce->getEmail() );
                $req->bindParam(':telephone', $annonce->getTelephone() );
                $req->bindParam(':adherent', $annonce->getAdherent()->getID() );
                $req->bindParam(':description', $annonce->getDescription() );
                $req->binDParam(':possede_bateau', $annonce->getPossedeBateau() );
                $req->execute();

                return true; 
            }
        }
        
        public function getAll(){
            $req = $this->bd->prepare('SELECT * FROM Adherent 
                WHERE date_fin < :now');
            $now = date(y-m-d);
            $req->bindParam(':now', $now );
            $annonces = $req->fetchAll();
            
            return $annonces;
        } */
    }
?>