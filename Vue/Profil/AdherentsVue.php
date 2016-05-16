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
        foreach($adherents as $adherent){
          echo '<div class  = "card-panel grey lighten-5">';
          echo '<center> <h2>';
          echo $adherent->getPseudo();
          echo '</h2></center>';
          echo '<div>';
          echo '<p>';
          echo '<b>Nom : </b>'.$adherent->getNom().'<br>';
          echo '<b>Prenom : </b>'.$adherent->getPrenom().'<br>';
          echo '<b>Email : </b>'.$adherent->getEmail().'<br>';
          echo '<b>Telephone : </b>'.$adherent->getTelephone().'<br>';
          echo '<b>Possède un bateau : </b>'.$adherent->getPossedeBateau().'<br>';
          echo '<b>Description : </b>'.$adherent->getDescription().'<br>';
          echo '</p>';
          echo '</div>';
          echo '</div>';
        } 
      ?>
      
    
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