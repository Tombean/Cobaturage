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
			echo '<center> <h2>';
			echo $adherent->getPseudo();
			echo '</h2></center>';
		?>
    <div>
      <p>
        <?php
          echo 'Nom : '.$adherent->getNom().'<br>';
          echo 'Prenom : '.$adherent->getPrenom().'<br>';
          echo 'Email : '.$adherent->getEmail().'<br>';
          echo 'Telephone : '.$adherent->getTelephone().'<br>';
          echo 'Possède un bateau : '.$adherent->getPossedeBateau().'<br>';
          echo 'Description : '.$adherent->getDescription().'<br>';
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