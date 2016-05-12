<?php
define('ROOT_PATH', '/adupp/');
require_once('Controller/ControllerAnnonces.php');
require_once('Controller/ControllerAchats.php');
require_once('Controller/ControllerAdherents.php');
//require_once('Controller/ControllerLieux.php');
//require_once('Controller/ControllerTypes.php');
require_once('Controller/ControllerDemandes.php');

//$url = $_SERVER['REQUEST_URI'];
$urlComplete = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$urlParse = parse_url($urlComplete);
$url = $urlParse['path'];
$racine = "/adupp/";

// ==> ca fonctionne
if ($url == "/adupp" || $url == "/adupp/"){
	require_once('accueil.php');
}

else {
	$url = str_replace($racine,"", $url);
	$uri ="";
	if ($url != "/") {
	    $uri = explode("/", $url);
	}

	$taille = count($uri);
	$i = 0;

	while( isset($uri[$i])){
		switch($uri[$i]){
			case "accueil.php":
				$i++;
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
						if (isset($_COOKIE['id_adherent'])){
							//necessite la creation de cookie et une connection
							$controllerAnnonces->create( $_COOKIE['id_adherent'], $_POST['lieu'],
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
						$controllerAnnonces->search(  htmlspecialchars($_POST) );
						break;
					case 'edit':
						$i++;
						if ( $uri[$i] != null && $uri[$i] != '' && preg_match('`^[[:digit:]]+$`', $uri[$i]) ){
							$controllerAnnonces->edit(  $id, htmlspecialchars($_PUT) );
						}
						break;
					default:
						# code...
						break;
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
			case 'profil':	
				$id = $_COOKIE["id"];
				$i++;
				if ( $id == null || !isset($_COOKIE["id"]) || $id ="" ){
						$erreur = "Vous devez être connecté(e) pour accéder à votre propre profil !";
						require_once("Vue/Erreur.php");
					}
				elseif ( $id=! null ){
					$controllerAdherents = new ControllerAdherents();
					$controllerAdherents->getByID( $id );
				}
				elseif( $uri[$i] == 'edit'){
					$i++;
					if ( $id=! null && $id == $uri[$i]){
						$controllerAdherents = new ControllerAdherents();
						$controllerAdherents->edit( $id, htmlspecialchars($_PUT) );
					}
					else{
						$erreur = "Vous ne pouvez éditez que votre propre profil !";
						require_once("Vue/Erreur.php");
					}
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
					print_r($_POST['pseudo']);
					print_r($_POST['password']);
					$controllerAdherents->checkConnection();
				}
				if (!isset($uri[$i])) { 
					require_once('Vue/Login/ConnexionVue.php');
				}
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
			default :
				$erreur = "Adresse inconnue. Avez-vous renseigner une URL correcte ?";
				require_once('Vue/Erreur.php');
				break;

		}
		$i++; 
	}
}

?>