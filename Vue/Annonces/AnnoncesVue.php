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
    	<h1><?php echo $message1;?> </h1>
    </center> 
    	<br>  
      <?php
        echo $message2;
        echo '<div class=\'row\'>';
          echo '<div class  = "card-panel blue lighten-3 col s6" style="font-style: italic;" > Les recherches </div>';
          echo '<div class  = "card-panel grey lighten-5 col s6" style="font-style: italic;" > Les propositions </div>';
        echo '</div>';
        foreach($annonces as $annonce){
          $couleur = "grey lighten-5";
          $cherche = 'Proposition :';
          if($annonce->getCherche() ==  1 || $annonce->getCherche() == true){
            $couleur = "blue lighten-3";
            $cherche = 'Recherche :';
          }
          echo '<div class  = "card-panel '.$couleur.'">';
            echo '<h4>'.$cherche.' du '.$annonce->getDateDebut().' au '.$annonce->getDateFin().' </h4>';
            echo "<p><ul>";
            echo '<li><b> Lieu d\'embarquement : </b>'.$annonce->getLieu()->getNom().' </li>';
            echo '<li><b> Types de sortie : </b>'.$annonce->getType()->getNom().' </li>';
            echo '<li><b> Commentaire de l\'annonceur : </b>'.$annonce->getCommentaire().' </li>';
            if($adherent_admin){
              echo '<li><a class="waves-effect waves-red btn" href="/adupp/mesAnnonces/delete/'.$annonce->getID().'" id="bouton_supprimer">Cliquez ici pour supprimer l\'annonce </a></li>';
            }
            if($mise_en_contact){
              echo '<a class="waves-effect waves-light btn" href="/adupp/adherent/'.$annonce->getAdherent()->getID().'" id="bouton_contacter">Contacter l\'annonceur </a>';

            }
            else{
              echo '<li><a class="waves-effect waves-red btn" href="/adupp/mesAnnonces/delete/'.$annonce->getID().'" id="bouton_supprimer">Cliquez ici pour supprimer votre annonce </a></li>';
            }
            echo '</ul></p>';

          echo '</div>';
        }
      ?>  
    <center>
      <h4>Pour revenir à l'accueil cliquer <a href="/adupp/" id='menu_annonces'>ici.</a></h4>
    </center>
		
    </div>

   <script type="text/javascript">
     $( document ).ready(function(){
        $(".button-collapse").sideNav();
        $('.parallax').parallax();
        var pseudo=getCookie("pseudo");
          var id=getCookie("id");
          var password=getCookie("password"); 
          if(pseudo != "" && id != "" && password != "" ){
              $("bouton_connexion").hide();
              $("bouton_deconnexion").show(); 
          }
          else{
            $("bouton_connexion").show();
            $("bouton_deconnexion").hide(); 
            var pseudo=getCookie("pseudo");
            var id=getCookie("id");
            var password=getCookie("password"); 
            if(pseudo != "" && id != "" && password != "" ){
                $("bouton_connexion").hide();
                $("bouton_deconnexion").show(); 
            }
            else{
              $("bouton_connexion").show();
              $("bouton_deconnexion").hide(); 
            }
          }
     })
   </script>
   <?php  include("includes/footer.php");?>
  </body>
</html>