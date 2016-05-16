<?php
require_once('Modele/Adherents/AdherentDAO.php');
require_once('Modele/Adherents/Adherent.php');
class AchatDAO{
	
	private $bd;
    private $adherentDAO;

    public function __construct(){
        $this->bd = new PDO('XXXXXXX', 'XXXXXXX', 'XXXXXXX', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->adherentDAO = new AdherentDAO();
	}

		/** Uses a Achats's ID to get the Achats
    	* @param  Achats's ID
         * @return Achats
         */
        public function getByID($id)
        {
             
            $req = $this->bd->prepare('SELECT * 
                FROM Achats 
                WHERE id_achat = :id');
            $req->bindParam(':id', $id );
            $req->execute();

            $result = $req->fetchAll();

            $adherent = new Adherent();
            $adherent = $this->adherentDAO->getByID($result[0]['adherent']);


            $achatromReq = new Achat($result[0]['id_achat'], $adherent, $result[0]['prix'], $result[0]['date_creation'], $result[0]['vend'],
                $result[0]['commentaire']);
            
            
            return $achatromReq;
        }

        /** Deletes an Achat in the database based on a given Achat's ID
         * This function will get the Achat's ID use it to delete the right annonce
         * @param  Achat's ID
         * @return nothing
         */
       
        public function deleteByID($id_achat)
        {
            $req = $this->bd->prepare('DELETE 
                FROM Achats 
                WHERE id_achat = :id');
            $req->bindParam(':id', $id_achat );
            $req->execute();
        }   

        //Achat($result[0]['id_achat'], $adherent, $result[0]['prix'], $result[0]['date_creation'], $result[0]['vend'],
        //        $result[0]['commentaire']);

        public function addAchat($achat)
        {
        	//$message = $achat->getCommentaire();
        	//require_once 'Vue/Message.php';
            $req = $this->bd->prepare('INSERT INTO Achats
                (adherent, prix, date_creation, commentaire, vend)
                VALUES(:adherent, :prix, :date_creation, :commentaire, :vend)');
            $date_creation = date_format($achat->getDateCreation(), 'Y-m-d');
            //$req->bindParam(':date_creation', $date_creation );
            //$req->bindParam(':prix', $achat->getPrix() );
            //$req->bindParam(':vend', $achat->getVend() );
            $id_adherent = $achat->getAdherent()->getID();
            //$req->bindParam(':adherent', $id_adherent );
            //$req->bindParam(':commentaire', $achat->getCommentaire() );

            $req->bindValue(':commentaire', $achat->getCommentaire(), PDO::PARAM_STR);
            $req->bindValue(':adherent', $id_adherent, PDO::PARAM_INT);
            $req->bindValue(':prix', $achat->getPrix() , PDO::PARAM_STR);
            $req->bindValue(':vend', $achat->getVend(), PDO::PARAM_BOOL);
            $req->bindValue(':date_creation', $date_creation, PDO::PARAM_STR);
            $req->execute();
            $id = $this->bd -> lastInsertId();
            $achat->setID($id);

        }

         public function getAll(){
            $achatsTab = array();
            $req = $this->bd->prepare('SELECT * FROM Achats 
                WHERE ADDDATE(date_creation, 90) > CURDATE()
                ORDER BY date_creation DESC;');
            //$now = date(y-m-d);
            //$req->bindParam(':now', $now );
            $req->execute();
            $results = $req->fetchAll();
            $i = 0;
            foreach($results as $result){

                $adherent = new Adherent();
                $adherent = $this->adherentDAO->getByID($result['adherent']);;


                $achatromReq = new Achat($result['id_achat'], $adherent, $result['prix'], $result['date_creation'], $result['vend'], $result['commentaire']);
                
                $achatsTab[$i] = $achatromReq;
                $i++;

            }

            return $achatsTab;
        }

        /** Will get all Achat from the database that are currently valid and are from a given Adherent
         * @param  Adherent Object
         * @return array of Achat
         */
        public function getAllFor(Adherent $adherent)
        {   
            $achatsTab = array();
            $req = $this->bd->prepare('SELECT *  
                FROM Achats 
                WHERE adherent = :id_adherent
                AND ADDDATE(date_creation, 90) > CURDATE()
                ORDER BY date_creation');
            $req->bindParam(':id_adherent', $adherent->getID() );
            $req->execute();
            $result = $req->fetchAll();
            
            $i = 0;
             while( isset($result[$i]) ){
                $achatromReq = new Achat($result['id_achat'], $adherent, $result['prix'], $result['date_creation'], $result['vend'], $result['commentaire']);
                
                $achatsTab[$i] = $achatromReq;
                $i++;

            }
            return $achatsTab;
        }
}

?>