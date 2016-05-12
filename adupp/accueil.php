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
       <h1> Créez votre annonce !</h1>
       <div class="row">
         <form class="col s12" action="/adupp/annonces/creation" method="post" >
            <div class="row">
                <div class="input-field col s6">
                  <select>
                    <option value="" disabled selected>Choisissez votre lieu d'embarquement</option>
                    <option value="1">Port de Dinard</option>
                    <option value="2">Port de Saint-Malo</option>
                    <option value="3">Plage de l'Ecluse</option>
                    <option value="3">Plage du Prieuré</option>
                  </select>
                  <label>Lieu d'embarquement :</label>
                </div>
               <div class="input-field col s6">
                  <select>
                    <option value="" disabled selected>Choisissez votre type de sortie</option>
                    <option value="1">Promenade</option>
                    <option value="2">Pêche en mer</option>
                    <option value="3">Voile</option>
                    <option value="3">Sport nautique (ski nautique, wakeboard, etc)</option>
                  </select>
                  <label>Type de sortie :</label>
                </div>
            </div>
            <div class="row">
               <div class="col s6">
                  <label>Date de début de période :</label>
                  <input type="date" class="datepicker">
               </div>
               <div class="col s6">
                  <label>Date de fin de période :</label>
                  <input type="date" class="datepicker">
               </div>
            </div>
            <div class="row">
                <div class = "col s6">
                  <label>Je recherche / Je propose une sortie :</label>
                  <div class="input-field">
                     <p>
                       <input id="true_cherche" type="radio" name="cherche" value="true" checked>
                       <label for="true_cherche">Je recherche</label>
                    </p>
                    <p>
                       <input id="false_cherche" type="radio" name="cherche" value="false" checked>
                       <label for="false_cherche">Je propose</label>
                    </p> 
                  </div>
                </div>
                <div class = "col s6">
                  <label>Eventuellement j'accepte / je demande une participation financière :</label>
                  <div class="input-field">
                     <p>
                       <input id="true_participation" type="radio" name="participation" value="true" checked>
                       <label for="true_participation">Oui</label>
                    </p>
                    <p>
                       <input id="false_participation" type="radio" name="participation" value="false" checked>
                       <label for="false_participation">Non</label>
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <textarea id="commentaire" class="materialize-textarea"></textarea>
                    <label for="commentaire">Commentaires sur l'annonce : </label>
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
     $( document ).ready(function(){
        $(".button-collapse").sideNav();
        $('select').material_select();
        $('.parallax').parallax();
     })
   </script>

   <?php require_once('index.php'); ?>

  </body>
</html>