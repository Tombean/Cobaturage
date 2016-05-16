<!DOCTYPE html>
<html lang="fr">
  <head>
      <?php  include("includes/head.php");?>
  </head>


  <body>

      <?php 
        include("includes/navbar.php");
        include("includes/parallaxe.php");
      ?>


     <div class="container">
       <h1> Descendez pour créer votre annonce :</h1>
       <p> <b>ATTENTION :</b> il est nécessaire d'avoir un compte et d'être connecté pour déposer une nouvelle annonce.<br>
       Pour créer son compte ou se connecter, cliquer sur "Connexion" en haut à droite.</p>
       <div class="row">
         <form class="col s12" action="/adupp/annonces/creation" method="post" >
            <div class="row">
                <div class="input-field col s6">
                  <select name="lieu">
                    <option value="" disabled selected>Choisissez votre lieu d'embarquement</option>
                    <?php 
                      foreach($lieux as $lieu){
                        echo "<option value=\"".$lieu->getID()."\">".(string)$lieu->getNom()."</option>";
                    }

                    ?>
                  </select>
                  <label>Lieu d'embarquement :</label>
                </div>
               <div class="input-field col s6">
                  <select name="type">
                    <option value="" disabled selected>Choisissez votre type de sortie</option>
                    <?php 
                      foreach($types as $type){
                        echo "<option value=\"".$type->getID()."\">".(string)$type->getNom()."</option>";
                    }

                    ?>
                    <!-- <option value="1">Promenade</option>
                    <option value="2">Pêche en mer</option>
                    <option value="3">Voile</option>
                    <option value="3">Sport nautique (ski nautique, wakeboard, etc)</option> -->
                  </select>
                  <label>Type de sortie :</label>
                </div>
            </div>
            <div class="row">
               <div class="col s6">
                  <label>Date de début de période (format : aaaa-mm-jj) :</label>
                  <input type="date" class="datepicker" id="datepicker" name="date_debut">
               </div>
               <div class="col s6">
                  <label>Date de fin de période (format : aaaa-mm-jj) :</label>
                  <input type="date" class="datepicker"  name="date_fin">
               </div>
            </div>
            <div class="row">
                <div class = "col s6">
                  <label>Je propose / Je recherche une sortie :</label>
                  
                  <div class="switch">
                    <label>
                      Je propose une sortie
                      <input name ="cherche" type="checkbox">
                      <span class="lever"></span>
                      Je cherche une sortie
                    </label>
                  </div>

                </div>
                <div class = "col s6">
                  <label>Eventuellement j'accepte / je demande une participation financière :</label>   
                  
                  <div class="switch">
                    <label>
                      Non
                      <input name ="participation" type="checkbox">
                      <span class="lever"></span>
                      Oui
                    </label>
                  </div>

                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <textarea id="commentaire" class="materialize-textarea" name="commentaire"></textarea>
                    <label for="commentaire">Texte de l'annonce (150 caractères maximum) : </label>
                  </div>
                </div>
            </div>
            <center>
              <button type="submit">Valider</button>
            </center>           
         </form>     
      </div>

     </div>

   <script type="text/javascript">
      function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
      };
       
     $( document ).ready(function(){

        $('.button-collapse').sideNav();
        $('select').material_select();
        $('.parallax').parallax();
        //$( ".datepicker" ).datepicker({ minDate: -10, maxDate: "+1M +10D" });
        /*var pseudo=getCookie("pseudo");
        var id=getCookie("id");
        var password=getCookie("password"); 
        if( pseudo != "" || pseudo != null  ){
              $("#bouton_connexion").hide();
              $("#bouton_deconnexion").show(); 
        }
        else{
          $("#bouton_connexion").show();
          $("#bouton_deconnexion").hide(); 
        } 
        */
        
     });
    
   </script>
   <?php  include("includes/footer.php");?>

  </body>
</html>