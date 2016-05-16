<?php

    require_once('Modele/Adherents/Adherent.php');
    
    class AdherentDAO{
        
        private $bd;
        
        public function __construct(){
            $this->bd = new PDO('XXXXXXX', 'XXXXXXX', 'XXXXXXX', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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
            $adherentFromReq = new Adherent($result[0]['id_adherent'], $result[0]['pseudo'], $result[0]['password'], $result[0]['nom'], $result[0]['prenom'], $result[0]['email'], $result[0]['telephone'], $result[0]['description'], $result[0]['possede_bateau'], $result[0]['admin'] );
            
            return $adherentFromReq;
        }

        /** Uses a Adherent to get the Adherent
         * @param  Adherent
         * @return Adherent's ID
         */
        public function getID($pseudo, $password)
        {   
            $req = $this->bd->prepare('SELECT id_adherent 
                FROM Adherents 
                WHERE pseudo = :pseudo
                AND password = :password;');
            
            $req->bindValue(':pseudo', $pseudo,PDO::PARAM_STR );
            $req->bindValue(':password', $password, PDO::PARAM_STR ); 
            $req->execute();
            $result = $req->fetchAll();
            return $result[0][0];
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
        public function addAdherent(Adherent $adherent)
        {
            $req = $this->bd->prepare('INSERT INTO Adherents
                (pseudo, password, nom, prenom, email, telephone, description, possede_bateau, admin)
                VALUES(:pseudo, :password, :nom, :prenom, :email, :telephone, :description, :possede_bateau, :admin)
                ');
            $req->bindParam(':pseudo', $adherent->getPseudo() );
            $req->bindParam(':password', $adherent->getPassword() );
            $req->bindParam(':nom', $adherent->getNom() );
            $req->bindParam(':prenom', $adherent->getPrenom() );
            $req->bindParam(':email', $adherent->getEmail() );
            $req->bindParam(':telephone', $adherent->getTelephone() );
            $req->bindParam(':description', $adherent->getDescription() );
            $req->bindParam(':possede_bateau', $adherent->getPossedeBateau() );
            $req->bindParam(':admin', $adherent->getAdmin() );
            $req->execute();
            $id = $this->bd -> lastInsertId();
            $adherent->setID($id);

        }

        
        public function edit(Adherent $adherent)
        {
            if ($adherent->getID() >= 0){
                $req = $this->bd->prepare('UPDATE Adherents
                SET pseudo = :pseudo,
                password = :password,
                nom = :nom,
                prenom = :prenom,
                email = :email,
                telephone = :telephone,
                description = :description,
                possede_bateau = :possede_bateau
                WHERE id_adherent = :id');
                 $req->bindParam(':pseudo', $adherent->getPseudo() );
                $req->bindParam(':password', $adherent->getPassword() );
                $req->bindParam(':nom', $adherent->getNom() );
                $req->bindParam(':prenom', $adherent->getPrenom() );
                $req->bindParam(':email', $adherent->getEmail() );
                $req->bindParam(':telephone', $adherent->getTelephone() );
                $req->bindParam(':description', $adherent->getDescription() );
                $req->binDParam(':possede_bateau', $adherent->getPossedeBateau() );
                $req->bindValue(':id', $adherent->getID(),PDO::PARAM_STR );
                $req->execute();
            }
        } 
        
        public function getAll(){
            $req = $this->bd->prepare('SELECT * FROM Adherents;');
            $req->execute();
            $results = $req->fetchAll();
            //$message = $results.' est le resultat de la requete. En results[0] on a : '.$results[0].' et en results[0][0] on a : '.$results[0][0];
            //require_once('Vue/Message.php');
            $adherents = array();
            $i = 0;
            foreach ($results as $result){
                $adherent = new Adherent($result['id_adherent'], $result['pseudo'], $result['password'], $result['nom'], $result['prenom'], $result['email'], $result['telephone'], $result['description'], $result['possede_bateau'], $result['admin'] );
                $adherents[$i] = $adherent;
                $i++;
            }
            
            return $adherents;
        }
    }
?>