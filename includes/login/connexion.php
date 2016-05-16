    <center> 
     <div class="row">
      <div class="col s12">  
        <div class="row">
          <form  action="connexion/succes" name"form_connexion" id="form_connexion" method="post">
            <div class="row">
              <div class="input-field col s12">
                <input id="pseudo" name="pseudo" type="text" class="validate">
                <label for="pseudo">Identifiant</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="password" name="password" type="password" class="validate">
                <label for="password">Mot de passe</label>
              </div>
            </div>
            
            <button class="waves-effect waves-light btn" type ="submit" form="form_connexion" value="form_connexion">Se connecter</button>
          </form>
          <div>
            <p></p>
            <a class="waves-effect waves-light btn" href="inscription">Pas encore inscrit(e) ?</a>
          </div>
        </div>
      </div>
    </div>
    </center>