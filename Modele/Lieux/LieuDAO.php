<?php
require_once('Modele/Lieux/Lieu.php');
class LieuDAO{
	private $bd;
        
        public function __construct(){
            $this->bd = new PDO('XXXXXXX', 'XXXXXXX', 'XXXXXXX', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }

        
        /** Uses a Type's ID to get the Type object
         * @param  Type's ID
         * @return Type
         */
        public function getByID($id)
        {
                
            $req = $this->bd->prepare('SELECT * 
                FROM Lieux 
                WHERE id_lieu = :id');
            $req->bindParam(':id', $id );
            $req->execute();
            $result = $req->fetchAll();
            $typeReq = new Lieu($result[0]['id_lieu'], $result[0]['nom']);
            
            return $typeReq;
        }

        /** Uses a Type's name to get the Type's ID
         * @param  nom
         * @return Type's ID
         */
        public function getID($nom)
        {
            $req = $this->bd->prepare('SELECT id_lieu
                FROM Lieux 
                WHERE nom = :nom ; ');
            
            $req->bindParam(':nom', $nom );
            $req->execute();

            $result = $req->fetchAll();
            return $result[0][0];
        }


        /** Deletes an Type in the database based on a given Type object
         * This function will get the Type's ID use it to delete the right type
         * @param  Type Object
         */
       
        public function deleteByID($lieu)
        {
            $id = $lieu->getID();
            $req = $this->bd->prepare('DELETE 
                FROM Lieux 
                WHERE id_type = :id');
            $req->bindParam(':id', $id );
            $req->execute();
        }


        /**  Adds a type in the database based on an Type Object
         * @param  Type object
         */
        public function addType($lieu)
        {
            $req = $this->bd->prepare('INSERT INTO Lieux
                (nom)
                VALUES(:nom);');
            $req->bindParam(':nom', $lieu->getNom() );
            $req->execute();
            $id = $this->bd -> lastInsertId();
            $lieu->setID($id);

        }

        public function edit($lieu)
        {
            if ($lieu->getID() >= 0){
                $req = $this->bd->prepare('UPDATE Lieux
                SET nom = :nom
                WHERE id_lieu = :id ;');
                $req->bindParam(':nom', $lieu->getNom() );
                $req->execute();
            }
        } 
        
        public function getAll(){
            $req = $this->bd->prepare('SELECT * FROM Lieux;');
            $req->execute();
            $results = $req->fetchAll();
            $lieux = array();
            $i = 0;
            foreach ($results as $result){
                $lieuReq = new Lieu($result['id_lieu'], $result['nom']);
                $lieux[$i] = $lieuReq;
                $i++;
            }
            
            return $lieux;
        }
}

?>