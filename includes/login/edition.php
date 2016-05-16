    <center>  
     <div class="row s8">
      <form class="col s12" id="form_edition" name="form_edition" method="POST" action="/adupp/profil/edit/succes">
        <center> <h3>Editez les informations à modifier. Le champ pseudo ne peut être modifié.</h3></center>  
        <center> <p>Pour editer un champ, activer en cliquant sur le bouton sous l'information correspondante. Un champ texte apparaitra pour y inscrire les nouvelles valeurs.</p></center> 
        <div class="row">
          <?php
            echo '<b>Nom : </b>'.$adherent->getNom().'<br>';
          ?>
          <div class="switch">
            <label>
              Ok
              <input id="check_editer_nom" name ="editer_nom" type="checkbox">
              <span class="lever"></span>
              Editer
            </label>
          </div>
        </div>
        <div class="row hidden" id="editer_nom">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input id="nom" type="text" name="nom" class="validate">
            <label for="telephone">Nouveau nom</label>
          </div>
        </div>

        <div class ="row">
          <?php
            echo '<b>Prenom : </b>'.$adherent->getPrenom().'<br>';
          ?>
          <div class="switch">
            <label>
              Ok
              <input id="check_editer_prenom" name ="editer_prenom" type="checkbox">
              <span class="lever"></span>
              Editer
            </label>
          </div>
        </div>
        <div class="row hidden" id="editer_prenom">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input id="prenom" type="text" name="prenom"    class="validate">
            <label for="telephone">Nouveau prénom</label>
          </div>
        </div>
        
        <div class="row">
          <?php
              echo '<b>Email : </b>'.$adherent->getEmail().'<br>';
          ?>
          <div class="switch">
            <label>
              Ok
              <input id="check_editer_mail" name ="editer_mail" type="checkbox">
              <span class="lever"></span>
              Editer
            </label>
          </div>
        </div>
        <div class="row hidden" id="editer_mail">
          <div class="input-field col s12">
            <i class="material-icons prefix">email</i>
            <input id="email" type="email" class="validate" name="email">
            <label for="telephone">Nouvelle adresse mail</label>
          </div>
        </div>

        <div class ="row">
          <?php 
            echo '<b>Telephone : </b>'.$adherent->getTelephone().'<br>';
          ?>
          <div class="switch">
            <label>
              Ok
              <input id="check_editer_telephone" name ="editer_telephone" type="checkbox">
              <span class="lever"></span>
              Editer
            </label>
          </div>
        </div>
        <div class="row hidden" id="editer_telephone">
          <div class="input-field col s12">
            <i class="material-icons prefix">phone</i>
            <input id="icon_telephone" type="tel" class="validate" name="telephone" id="telephone">
            <label for="telephone">Nouveau numéro de téléphone</label>
          </div>
        </div>

        <div class="row">
          <?php 
            $possede = 'Non';
            if ($adherent->getPossedeBateau()){$possede = 'Oui';}
            echo '<b>Possède un bateau : </b>'.$possede.'<br>';
          ?>
          <div class="switch">
            <label>
              Ok
              <input id="check_editer_possede" name ="editer_possede" type="checkbox">
              <span class="lever"></span>
              Editer
            </label>
          </div>
        </div>
        <div class = "row hidden" id="editer_possede">
            <label>Je possède mon propre bateau :</label>
              <div class="switch">
                <label>
                  Non
                  <input name ="possede_bateau" type="checkbox">
                  <span class="lever"></span>
                  Oui
                </label>
              </div>
         </div>

         <div class="row">
          <?php 
            echo '<b>Description : </b>'.$adherent->getDescription().'<br>';
          ?>
          <div class="switch">
            <label>
              Ok
              <input id="check_editer_description" name ="editer_description" type="checkbox">
              <span class="lever"></span>
              Editer
            </label>
          </div>
        </div>
        <div class="row hidden" id="editer_description">
            <div class="input-field col s12">
               <textarea id="description" name="description" class="materialize-textarea"></textarea>
               <label for="description">Nouvelle description</label>
            </div>
        </div>
        
        <div class="row">
          <?php 
            echo '<b>Changer de mot de passe ?</b><br>';
          ?>
          <div class="switch">
            <label>
              Ok
              <input id="check_editer_password" name ="editer_password" type="checkbox">
              <span class="lever"></span>
              Editer
            </label>
          </div>
        </div>

        <div class="row hidden" id="editer_password">
          <div class="input-field col s12">
            <i class="material-icons prefix">verified_user</i>
            <input id="password" type="password" name="password" class="validate">
            <label for="password">Nouveau mot de passe</label>
          </div>
        </div>
        <div class="row hidden" id="editer_password_verif">
          <div class="input-field col s12">
            <i class="material-icons prefix">verified_user</i>
            <input id="password_verif" type="password" name="password_verif" class="validate">
            <label for="password_verif">Retapez votre nouveau mot de passe</label>
          </div>
        </div>
        
        
        
         
        
        <button class="waves-effect waves-light btn" id="bouton_edition" type="submit" >Valider les changements</button>
        <a class="waves-effect waves-light btn" href="/adupp/" id="bouton_annuler">Annuler</a>
        
      </form>
    </div>

  <script type="text/javascript">
      $('.hidden').each(function(index) {
        $(this).hide();
      });
      $('#check_editer_nom').click(function() {
        $('#editer_nom').toggle();
      });
      $('#check_editer_prenom').click(function() {
        $('#editer_prenom').toggle();
      });
      $('#check_editer_mail').click(function() {
        $('#editer_mail').toggle();
      });
      $('#check_editer_telephone').click(function() {
        $('#editer_telephone').toggle();
      });
      $('#check_editer_possede').click(function() {
        $('#editer_possede').toggle();
      });
      $('#check_editer_description').click(function() {
        $('#editer_description').toggle();
      });
      $('#check_editer_password').click(function() {
        $('#editer_password').toggle();
      });
      $('#check_editer_password').click(function() {
        $('#editer_password_verif').toggle();
      });
  </script>