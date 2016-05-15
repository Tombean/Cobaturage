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
        <div class="parallax"><img src="image/ponton.jpg" class = "responsive-img" alt="ponton de l'adupp"></div>
      </div>

      <div style='margin: auto';>
        
        <?php include("includes/login/edition.php");?>

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