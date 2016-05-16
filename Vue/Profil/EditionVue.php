<!DOCTYPE html>
<html lang="fr">
  <head>
      <?php 
        include("includes/head.php");
      ?>
     
  </head>


  <body>

      <?php 
        include("includes/navbar.php");
      ?>

      <!--  <div style='margin: auto;'> -->
        
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