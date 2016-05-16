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
      echo '<div class  = "card-panel grey lighten-5">';  
			echo '<center> <h2>';
			echo $adherent->getPseudo();
			echo '</h2></center>';
		?>
    <div>
      <p>
        <?php
          echo '<b>Nom : </b>'.$adherent->getNom().'<br>';
          echo '<b>Prenom : </b>'.$adherent->getPrenom().'<br>';
          echo '<b>Email : </b>'.$adherent->getEmail().'<br>';
          echo '<b>Telephone : </b>'.$adherent->getTelephone().'<br>';
          $possede = 'Non';
          if ($adherent->getPossedeBateau()){$possede = 'Oui';}
          echo '<b>Possède un bateau : </b>'.$possede.'<br>';
          echo '<b>Description : </b>'.$adherent->getDescription().'<br>';
          echo '<a class="waves-effect waves-light btn" href="/adupp/profil/edit" id="bouton_edit_profil">Editez votre profil</a>';
          echo '</div>';
        ?>
      </p>
    </div>
    <center>
      <h4>Pour revenir à l'accueil cliquez <a href="/adupp/" id='menu_annonces'>ici.</a></h4>
    </center>
		
    </div>

   <script type="text/javascript">
     $( document ).ready(function(){
        $(".button-collapse").sideNav();
     })
   </script>
   <?php  include("includes/footer.php");?>
  </body>
</html>