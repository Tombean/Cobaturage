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
    	<?php   
			echo '<center> <h2>Voici l\'annonce que vous cherchiez ! </h2></center> <br>';
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
            echo '<li><a href="/adupp/adherent/'.$annonce->getAdherent()->getID().'">Contacter l\'annonceur </li>';
            echo "</ul></p>";
          echo '</div>';
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