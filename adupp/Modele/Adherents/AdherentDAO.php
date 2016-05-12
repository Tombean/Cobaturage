<?php

    require_once('Modele/Adherents/Adherent.php');
    
    class AdherentDAO{
        
        private $bd;
        
        public function __construct(){
            
            try {
                $DB_HostName = "localhost";
                $DB_Name = "glecam_cobaturage";
                $DB_User = "root";
                $DB_Pass = "";
                $bd = new PDO("mysql:host=$DB_HostName;dbname=$DB_Name", $DB_user, $DB_Pass);
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
            //$bd = new PDO('mysql:host=localhost;dbname=glecam_cobaturage;charset=utf8', 'root', '');
        }

        
        /** Uses a Annonce's ID to get the Annonce
         * @param  Annonce's ID
         * @return Annonce
         */
        public function getByID($id)
        {
                
            $req = $bd->prepare('SELECT * 
                FROM Adherent 
                WHERE id_adherent = :id');
            $req->bindParam(':id', $id );
            $req->execute();
            $result = $req->fetchAll();
            $adherentFromReq = new Adherent($result[0]['id_adherent'], $result[0]['pseudo'], $result[0]['password'], $result[0]['nom'], $result[0]['prenom'], $result[0]['email'], $result[0]['telephone'], $result[0]['description'], $result[0]['possede_bateau'] );
            
            return $adherentFromReq;
        }


        /** Deletes an Annonce in the database based on a given Annonce object
         * This function will get the Annonce's ID use it to delete the right annonce
         * @param  Annonce Object
         * @return nothing
         */
       
        public function deleteByID($adherent)
        {
            $id = $adherent->getID();
            $req = $bd->prepare('DELETE 
                FROM Adherent 
                WHERE id_adherent = :id');
            $req->bindParam(':id', $id );
            $req->execute();
        }


        /**  Adds an adherent in the database based on an Adherent Object
         * @param  Integer :  the adherent's ID
         */
        public function addAdherent($adherent)
        {
            $req = $bd->prepare('INSERT INTO Adherent
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
            $id = $bd -> lastInsertId();
            $adherent->setID($id);

        }

        
        public function edit($adherent)
        {
            if ($annonce.getID() >= 0){
                $req = $bd->prepare('UPDATE Adherent
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
            $req = $bd->prepare('SELECT * FROM Adherent 
                WHERE date_fin < :now');
            $now = date(y-m-d);
            $req->bindParam(':now', $now );
            $annonces = $req->fetchAll();
            
            return $annonces;
        }
    }
?>