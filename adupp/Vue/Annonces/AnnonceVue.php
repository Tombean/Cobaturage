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
			echo '<center> <h1>Voici l\'annonce que vous cherchiez ! </h1></center> <br>';
			echo $annonce->getID();
			echo $annonce->getCommentaire();
		?>
    <center>
      <h2>Pour revenir à l'accueil cliquer <a href="/adupp/" id='menu_annonces'>ici.</a></h2>
    </center>
		
    </div>

   <script type="text/javascript">
     $( document ).ready(function(){
        $(".button-collapse").sideNav();
        $('.parallax').parallax();
     })
   </script>

  </body>
</html>