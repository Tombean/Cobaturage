<!DOCTYPE html>
<html lang="fr">
  <head>
      <?php 
        include("includes/head.php");
      ?>
  </head>


  <body>
    <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>

      <?php 
      include("includes/navbar.php");
      ?>


      <div class="container">
       <h3> Créez votre annonce d'achat ou vente ou descendez pour consulter la liste des annonces existantes:</h3>
       <p> <b>ATTENTION :</b> il est nécessaire d'avoir un compte et d'être connecté pour déposer une nouvelle annonce.<br>
       Pour créer son compte ou se connecter, cliquer sur "Connexion" en haut à droite.</p>
       <div class="row">
         <form class="col s12" action="/adupp/achats/creation" method="post" >
            <div class="row">
                <div class="row " id="prix">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">payment</i>
                    <input id="prix" type="text" name="prix" class="validate">
                    <label for="prix">Prix : </label>
                  </div>
                </div>
              
            <div class="row">
                <div class = "col s12">
                  <label>J'achète ou je vends :</label>   
                  
                  <div class="switch">
                    <label>
                      Achat
                      <input name ="vend" type="checkbox">
                      <span class="lever"></span>
                      Vente
                    </label>
                  </div>

                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <textarea id="commentaire" class="materialize-textarea" name="commentaire"></textarea>
                    <label for="commentaire">Commentaires sur l'annonce : </label>
                  </div>
                </div>
            </div>
            <center>
              <button type="submit" class="waves-effect waves-light btn">Créer votre annonce</button>
            </center>           
         </form>     
      </div>

     </div>




    <div class="container">
    <center> 
    	<h3><?php echo $message1;?> </h3>
    </center> 
    	<br>  
      <?php
        echo $message2;
        echo '<div class=\'row\'>';
          echo '<div class  = "card-panel blue lighten-3 col s6" style="font-style: italic;" > Les recherches </div>';
          echo '<div class  = "card-panel grey lighten-5 col s6" style="font-style: italic;" > Les propositions </div>';
        echo '</div>';
        foreach($achats as $achat){
          $couleur = "grey lighten-5";
          $cherche = 'Achat :';
          if($achat->getVend() ==  1 || $achat->getVend() == true){
            $couleur = "blue lighten-3";
            $cherche = 'Vente :';
          }
          echo '<div class  = "card-panel '.$couleur.'">';
            echo '<h4>'.$cherche.' datant du '.$achat->getDateCreation().' </h4>';
            echo "<p><ul>";
            echo '<li><b> Prix : </b>'.$achat->getPrix().' </li>';
            echo '<li><b> Commentaire de l\'annonceur : </b>'.$achat->getCommentaire().' </li>';
            if($adherent_admin){
              echo '<li><a class="waves-effect waves-red btn" href="/adupp/mesAchats/delete/'.$achat->getID().'" id="bouton_supprimer">Cliquez ici pour supprimer l\'annonce </a></li>';
            }
            if($mise_en_contact){
              echo '<a class="waves-effect waves-light btn" href="/adupp/adherent/'.$achat->getAdherent()->getID().'" id="bouton_contacter">Contacter l\'annonceur </a>';

            }
            else{
              echo '<li><a class="waves-effect waves-red btn" href="/adupp/mesAchats/delete/'.$achat->getID().'" id="bouton_supprimer">Cliquez ici pour supprimer votre annonce </a></li>';
            }

            echo '</ul></p>';
          echo '</div>';
        }
      ?>  
    <center>
      <h4>Pour revenir à l'accueil cliquer <a href="/adupp/" id='menu_achat'>ici.</a></h4>
    </center>
		
    </div>

   <script type="text/javascript">
     $( document ).ready(function(){
        $(".button-collapse").sideNav();
        $('.parallax').parallax();
        
     });
   </script>
   <?php  include("includes/footer.php");?>
  </body>
</html>