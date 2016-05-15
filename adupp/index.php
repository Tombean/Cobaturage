<?php
define('ROOT_PATH', '/adupp/');
require_once('Controller/ControllerAnnonces.php');
require_once('Controller/ControllerAchats.php');
require_once('Controller/ControllerAdherents.php');
require_once('Controller/ControllerLieux.php');
require_once('Controller/ControllerTypes.php');
require_once('Controller/ControllerDemandes.php');

//$url = $_SERVER['REQUEST_URI'];
$urlComplete = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$urlParse = parse_url($urlComplete);
$url = $urlParse['path'];
$racine = "/adupp/";


// ==> ca fonctionne
/*if ($url == "/adupp" || $url == "/adupp/"){
	$controllerTypes = new ControllerTypes();
	$types = $controllerTypes->getAll();
	require_once('accueil.php');
} */

//else {
	$url = str_replace($racine,"", $url);
	$uri ="";
	if ($url != "/") {
	    $uri = explode("/", $url);
	}

	$taille = count($uri);
	$i = 0;

	while( isset($uri[$i])){
		switch($uri[$i]){
			case "":
				$controllerTypes = new ControllerTypes();
				$types = $controllerTypes->getAll();
				$controllerLieux = new ControllerLieux();
				$lieux = $controllerLieux->getAll();
				require_once('accueil.php');
				break;
			case "accueil":
				$i++;
				$controllerTypes = new ControllerTypes();
				$types = $controllerTypes->getAll();
				require_once("accueil.php");
				break;
			case "index.php":
				$i++;
				require_once("accueil.php");
				break;
			case "annonces":
				$i++;
				$controllerAnnonces = new ControllerAnnonces();
				if ( isset($uri[$i]) && $uri[$i] != '' && preg_match('`^[[:digit:]]+$`', $uri[$i]) ){
					$controllerAnnonces->getByID($uri[$i]);
				}
				if (!isset($uri[$i]) || $uri[$i] == null || $uri[$i] == ''){
					$controllerAnnonces->getAll();
				}
				else{
					switch ($uri[$i]) {
					case 'creation':
						if ($_COOKIE['id'] != null && $_COOKIE['id'] != ''){
							//necessite la creation de cookie et une connection
							$controllerAnnonces->create( $_POST['lieu'],
							 $_POST['date_debut'],
							 $_POST['date_fin'],
							 $_POST['type'],
							 (boolean)$_POST['cherche'],
							 (boolean)$_POST['participation'],
							 $_POST['commentaire']);
						}
						else{
							$erreur ="Il est necessaire d'etre connecté pour pouvoir poster une annonce !";
							require_once("Vue/Erreur.php");
						}
						break;
					case 'recherche':
						$controllerAnnonces->search( );
						break;
					case 'edit':
						$i++;
						if ( $uri[$i] != null && $uri[$i] != '' && preg_match('`^[[:digit:]]+$`', $uri[$i]) ){
							$id = $uri[$i];
							$controllerAnnonces->edit(  $id );
						}
						break;
					case 'last':
						$i++;
						if ( $uri[$i] != null && $uri[$i] != '' && preg_match('`^[[:digit:]]+$`', $uri[$i]) ){
							$limit = (int)$uri[$i];
							$controllerAnnonces->last(  $limit );
						}
						else{
							$controllerAnnonces->getAll();
						}

					} 
				}
				break;
			case 'adherent':
				$i++;
				$controllerAdherents = new ControllerAdherents();
				if ( $uri[$i] != null && $uri[$i] != '' && preg_match('`^[[:digit:]]+$`', $uri[$i]) ){
					$controllerAdherents->getByID( $uri[$i] );
				}
				break;
			case 'adherents':
				$i++;
				$controllerAdherents = new ControllerAdherents();
				$controllerAdherents->getAll();
				break;
			case 'profil':	
				$id_adherent = $_COOKIE['id'];
				$controllerAdherents = new ControllerAdherents();
				$i++;
				if ( $id_adherent == null || !isset($_COOKIE['id']) || $id_adherent ="" ){
						$erreur = "Vous devez être connecté(e) pour accéder à votre propre profil !";
						require_once("Vue/Erreur.php");
					}
				elseif( $uri[$i] == 'edit'){
					$i++;
					if ( $id_adherent =! null && $id_adherent !='' && $id_adherent != 0 && $controllerAdherents->checkConnectionBool() ){
						$controllerAdherents->edit( $id_adherent );
					}
					else{
						$erreur = "Vous ne pouvez éditer que votre propre profil !";
						require_once("Vue/Erreur.php");
					}
				}
				elseif ( $id_adherent=! null ){
					$id_adherent = (int)$_COOKIE['id'];
					$controllerAdherents->getByID( $id_adherent );
				}
				break;
			case 'achats':
				/*$i++;
				$controllerAchats = new ControllerAchats();
				if ( $uri[$i] != null && $uri[$i] != '' && preg_match('`^[[:digit:]]+$`', $uri[$i]) ){
					$controllerAchats->getByID($uri[$i]);
				}
				switch ($uri[$i]) {
					case 'creation':
						$controllerAchats->create( $_POST );
						break;
					case 'recherche':
						$controllerAchats->search(  htmlspecialchars($_POST) );
						break;
					default:
						# code...
						break; 
				}*/
				$erreur = "Les achats / ventes ne sont pas encore disponnibles. Mise à jour très prochainement ! :)";
				require_once('Vue/Erreur.php');
				break;
			case 'connexion':
				$controllerAdherents = new ControllerAdherents();
				$i++;
				if (isset($uri[$i]) && $uri[$i] == 'succes'){
					$controllerAdherents->checkConnection();
				}
				if (!isset($uri[$i])) { 
					require_once('Vue/Login/ConnexionVue.php');
				}
				break;
			case 'deconnexion' :
				if (isset($_COOKIE['pseudo'])) {
                        unset($_COOKIE['pseudo']);
                        setcookie('pseudo', '', time() - 3600, '/adupp/'); // empty value and old timestamp
                }
                if (isset($_COOKIE['password'])) {
                        unset($_COOKIE['password']);
                        setcookie('password', '', time() - 3600, '/adupp/'); 
                
                        unset($_COOKIE['id']);
                        setcookie('id', '', time() - 3600, '/adupp/'); 
                }
                $message = "Vous avez été correctement déconnecté(e).";
                require_once('Vue/Message.php');
                break;
			case 'inscription':
				$controllerAdherents = new ControllerAdherents();
				$i++;
				if (isset($uri[$i]) && $uri[$i] == 'nouveau'){
					$controllerAdherents->add();
				}
				if (!isset($uri[$i])) {
					require_once('Vue/Login/InscriptionVue.php');
				}
				break;
			case 'mesAnnonces':
				$id_adherent = (int)$_COOKIE['id'];
				$controllerAnnonces= new ControllerAnnonces();
				$i++;
				if ( $id_adherent == null || !isset($_COOKIE['id']) || $id_adherent ="" ){
						$erreur = "Vous devez être connecté(e) pour accéder à vos annonces !";
						require_once("Vue/Erreur.php");
					}
				else{
					$controllerAnnonces->getAllFor();
				}
				/*elseif( $uri[$i] == 'edit'){
					$i++;
					$message = $id_adherent;
					require_once 'Vue/Message.php';
					if ( $id_adherent =! null && $id_adherent !='' && $id_adherent != 0 && $controllerAdherents->checkConnectionBool() ){
						$controllerAdherents->edit( $id_adherent );
					}
					else{
						$erreur = "Vous ne pouvez éditez que votre propre profil !";
						require_once("Vue/Erreur.php");
					} */
				break;

			default :
				$erreur = "Adresse inconnue. Avez-vous renseigné une URL correcte ?";
				require_once('Vue/Erreur.php');
				break;

		}
		$i++; 
	}
//}

?>