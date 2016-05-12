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
    	<h1>Voici l'ensemble des annonces à jour du site ! </h1>
    </center> 
    	<br>  
      <?php
        $taille = count($annonces);
        echo 'Il y a '.$taile.' annonces sur le site, les voici : <br>';
        for ($i = 0; $i < $taille; $i++){
          echo $annonces[$i]->getID();
          echo $annonces[$i]->getCommentaire();
        }
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