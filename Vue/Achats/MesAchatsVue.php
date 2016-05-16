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