<?php
require_once('Modele/Types/Type.php');

class TypeDAO{

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
                FROM Types 
                WHERE id_type = :id');
            $req->bindParam(':id', $id );
            $req->execute();
            $result = $req->fetchAll();
            $typeReq = new Type($result[0]['id_type'], $result[0]['nom']);
            
            return $typeReq;
        }

        /** Uses a Type's name to get the Type's ID
         * @param  nom
         * @return Type's ID
         */
        public function getID($nom)
        {
            $req = $this->bd->prepare('SELECT id_type 
                FROM Types 
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
       
        public function deleteByID($type)
        {
            $id = $type->getID();
            $req = $this->bd->prepare('DELETE 
                FROM Types 
                WHERE id_type = :id');
            $req->bindParam(':id', $id );
            $req->execute();
        }


        /**  Adds a type in the database based on an Type Object
         * @param  Type object
         */
        public function addType($type)
        {
            $req = $this->bd->prepare('INSERT INTO Types
                (nom)
                VALUES(:nom);');
            $req->bindParam(':nom', $type->getNom() );
            $req->execute();
            $id = $this->bd -> lastInsertId();
            $type->setID($id);

        }

        public function edit($type)
        {
            if ($type->getID() >= 0){
                $req = $this->bd->prepare('UPDATE Types
                SET nom = :nom
                WHERE id_type = :id ;');
                $req->bindParam(':nom', $type->getNom() );
                $req->execute();
            }
        } 
        
        public function getAll(){
            $req = $this->bd->prepare('SELECT * FROM Types;');
            $req->execute();
            $results = $req->fetchAll();
            $types = array();
            $i = 0;
            foreach ($results as $result){
                $typeReq = new Type($result['id_type'], $result['nom']);
                $types[$i] = $typeReq;
                $i++;
            }
            
            return $types;
        }
    }
?>