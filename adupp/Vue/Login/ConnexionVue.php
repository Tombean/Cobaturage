<!DOCTYPE html>
<html lang="fr">
  <head>
      <?php 
        include("includes/head.php");
      ?>
      <style type="text/css">
        .parallax-container {
          height: "400";
        }
      </style>
  </head>


  <body>

      <?php 
        include("includes/navbar.php");
      ?>
      <div class="parallax-container">
        <div class="parallax"><img src="image/palais_breton.jpg" class = "responsive-img" alt="palais breton"></div>
      </div>

      <div style='margin: auto';>
        
        <?php include("includes/login/connexion.php");?>

      </div>

   <script type="text/javascript">
     $( document ).ready(function(){
        $(".button-collapse").sideNav();
        $('.parallax').parallax();
     })
   </script>

  </body>
</html>