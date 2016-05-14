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
        foreach($annonces as $annonce){
            echo '<h3> Du '.$annonce->getDateDebut().' au '.$annonce->getDateFin().' </h3>';
            echo "<p><ul>";
            echo '<li> Lieu d\'embarquement : '.$annonce->getLieu()->getNom().' </li>';
            echo "</ul></p>";
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
     })
   </script>
   <?php  include("includes/footer.php");?>
  </body>
</html>