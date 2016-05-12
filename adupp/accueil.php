<!DOCTYPE html>
<html lang="fr">
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>


      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Cobaturage</title>

        <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">

      <!-- Compiled and minified JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style type="text/css">
        #texte_intro{
          z-index = 20!important;
          position: relative!important;
        }
        #image_parallaxe{
          z-index = 1!important;
          position: absolute!important;
        }
      </style>


 
  </head>


  <body>
    <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>

      <?php 
      include("includes/navbar.php"); 
      ?>

     <div class="parallax-container">
      <div class="parallax">
        <img src="image/dinard_tentes_60.jpg" alt="baie de saint-malo" class = "responsive-img" id="image_parallax">
        <div class="section" id="texte_intro">
          <div class="container">
          <div class ="row">
            <h2 class="header white-text">Préparez vos sorties en mer en toute tranquillité</h2>
            <p class="white-text">L'ADUPP vous propose son service de cobaturage. Ici vous pouvez proposer à des gens, mais aussi chercher des gens qui, comme vous, veulent profiter de la mer.
            Promenade en mer, pêche, voile ou sports nautiques, tout y est et tout le monde trouvera son bonheur. Parcourez les annonces ou créez la votre !
            La mer et les rencontres vous attendent ici !</p>
              <div class = "row card-panel grey lighten-5" id='menu_annonces_description'>
                <div class="col l3" >
                  <p>
                    <strong>Loisirs / Echanges</strong><br>
                    Voir les propositions de services et index de recherche
                  </p>
                </div>

                <div class="col l3">
                  <p>
                    <strong>Achats / Ventes</strong><br>
                    Voir les propositions de vente ou achat de matériels.
                  </p>
                </div>

                <div class="col l3">
                  <p>
                    <strong>Mes annonces / demandes</strong><br>
                    Permet de lister les éléments de mon compte.
                  </p>
                </div>

                <div class="col l3">
                  <p>
                    <strong>Mon profil</strong><br>
                    Permet de consulter mon profil et éventuellement de le modifier.
                  </p>
                </div>
                </div>

              </div>
          </div>
        </div>
      </div>
    </div>

     <div class="container">
       <h1> Créez votre annonce !</h1>
       <div class="row">
         <form class="col s12" action="/adupp/annonces/creation" method="post" >
            <div class="row">
                <div class="input-field col s6">
                  <select>
                    <option value="" disabled selected>Choisissez votre lieu d'embarquement</option>
                    <option value="1">Port de Dinard</option>
                    <option value="2">Port de Saint-Malo</option>
                    <option value="3">Plage de l'Ecluse</option>
                    <option value="3">Plage du Prieuré</option>
                  </select>
                  <label>Lieu d'embarquement :</label>
                </div>
               <div class="input-field col s6">
                  <select>
                    <option value="" disabled selected>Choisissez votre type de sortie</option>
                    <option value="1">Promenade</option>
                    <option value="2">Pêche en mer</option>
                    <option value="3">Voile</option>
                    <option value="3">Sport nautique (ski nautique, wakeboard, etc)</option>
                  </select>
                  <label>Type de sortie :</label>
                </div>
            </div>
            <div class="row">
               <div class="col s6">
                  <label>Date de début de période :</label>
                  <input type="date" class="datepicker">
               </div>
               <div class="col s6">
                  <label>Date de fin de période :</label>
                  <input type="date" class="datepicker">
               </div>
            </div>
            <div class="row">
                <div class = "col s6">
                  <label>Je recherche / Je propose une sortie :</label>
                  <div class="input-field">
                     <p>
                       <input id="true_cherche" type="radio" name="cherche" value="true" checked>
                       <label for="true_cherche">Je recherche</label>
                    </p>
                    <p>
                       <input id="false_cherche" type="radio" name="cherche" value="false" checked>
                       <label for="false_cherche">Je propose</label>
                    </p> 
                  </div>
                </div>
                <div class = "col s6">
                  <label>Eventuellement j'accepte / je demande une participation financière :</label>
                  <div class="input-field">
                     <p>
                       <input id="true_participation" type="radio" name="participation" value="true" checked>
                       <label for="true_participation">Oui</label>
                    </p>
                    <p>
                       <input id="false_participation" type="radio" name="participation" value="false" checked>
                       <label for="false_participation">Non</label>
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <textarea id="commentaire" class="materialize-textarea"></textarea>
                    <label for="commentaire">Commentaires sur l'annonce : </label>
                  </div>
                </div>
            </div>
            <center>
              <button type="submit">Valider</button>
            </center>           
         </form>     
      </div>

     </div>

   <script type="text/javascript">
     $( document ).ready(function(){
        $(".button-collapse").sideNav();
        $('select').material_select();
        $('.parallax').parallax();
     })
   </script>

   <?php require_once('index.php'); ?>

  </body>
</html>