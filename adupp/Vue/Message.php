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
			echo '<center> <h1>';
			echo $message;
			echo '</h1></center>';
		?>
    <center>
      <h4>Pour revenir à l'accueil cliquez <a href="/adupp/" id='menu_annonces'>ici.</a></h4>
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
              $("#bouton_connexion").hide();
              $("#bouton_deconnexion").show(); 
          }
          else{
            $("#bouton_connexion").show();
            $("#bouton_deconnexion").hide(); 
          }
     })
   </script>
   <?php  include("includes/footer.php");?>
   
  </body>
</html>