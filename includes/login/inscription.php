
    
      <script type="text/javascript">
        function verif()
        {
          var erreur = 0;
           if(document.getElementById('prenom').value == "")
           {
              alert('Le champ pseudo est vide ! Veuillez inscrire votre pseudo s\'il vous plait');
              erreur++;
           }
          if(document.getElementById('nom').value == "" )
           {
              alert('Le champ nom est vide ! Veuillez inscrire votre nom s\'il vous plait');
              erreur++;
           }
           if(document.getElementById('prenom').value == "" )
           {
              alert('Le champ prénom est vide ! Veuillez inscrire votre prénom s\'il vous plait');
              erreur++;
           }
           if(document.getElementById('telephone').value == "" )
           {
              alert('Le champ telephone est vide ! Veuillez inscrire votre numéro de telephone s\'il vous plait');
              erreur++;
           }
           if(document.getElementById('password').value == "" )
           {
              alert('Le champ mot de passe est vide ! Veuillez inscrire votre mot de passe s\'il vous plait');
              erreur++;
           }
           if(document.getElementById('password').value !== document.getElementById('password_verif').value )
           {
              alert('Le premier et le second mot de passe indiqués ne correspondent pas ! Veuillez inscrire à nouveau votre mot de passe dans les 2 champs s\'il vous plait');
              erreur++;
           }
           if(erreur == 0){
            document.getElementById('form_inscription').submit();
           }
            
        }
      </script>
    <center>  
     <div class="row s8">
      <form class="col s12" id="form_inscription" name="form_inscription" method="POST" action="inscription/nouveau">
        <h2>Votre pseudo vous servira à chaque connexion, notez-le bien.</h2>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input id="pseudo" type="text" name="pseudo" class="validate">
            <label for="pseudo">Pseudo</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input id="prenom" type="text" name="prenom" class="validate">
            <label for="prenom">Prénom</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input id="nom" type="text" name="nom" class="validate">
            <label for="nom">Nom</label>
          </div>
        </div>
        <div class="row">
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">verified_user</i>
            <input id="password" type="password" name="password" class="validate">
            <label for="password">Mot de passe</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">verified_user</i>
            <input id="password_verif" type="password" name="password_verif" class="validate">
            <label for="password_verif">Retapez votre mot de passe</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">email</i>
            <input id="email" type="email" class="validate" name="email">
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">phone</i>
            <input id="icon_telephone" type="tel" class="validate" name="telephone" id="telephone">
            <label for="icon_telephone">Telephone</label>
          </div>
        </div>
        <div class = "row">
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
            <div class="input-field col s12">
               <textarea id="description" name="description" class="materialize-textarea"></textarea>
               <label for="description">Presentez-vous en quelques mots : </label>
            </div>
          </div>
        
        <button id="bouton_inscription" type="submit" onmouseover="verif()" onclick="verif()">S'inscrire</button>
        
      </form>
    </div>
  </center>