    <center>  
     <div class="row s8">
      <form class="col s12" id="form_edition" name="form_edition" method="PUT" action="profil/edit">
        <h2>Editez les champs ayant changé. Le champ pseudo ne peut etre modifié..</h2>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input id="prenom" type="text" name="prenom"  value="<?php $adherent->getPrenom();?>"  class="validate">
            <label for="prenom"><?php echo $adherent->getPrenom();?></label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input id="nom" type="text" name="nom" value="<?php $adherent->getNom();?>" class="validate">
            <label for="nom"><?php echo $adherent->getNom();?></label>
          </div>
        </div>
        <div class="row">
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">verified_user</i>
            <input id="password" type="password" name="password" class="validate">
            <label for="password">Nouveau mot de passe</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">verified_user</i>
            <input id="password_verif" type="password" name="password_verif" class="validate">
            <label for="password_verif">Retapez votre nouveau mot de passe</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">email</i>
            <input id="email" type="email" class="validate" value="<?php $adherent->getEmail();?> name="email">
            <label for="email"><?php echo $adherent->getEmail();?></label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">phone</i>
            <input id="icon_telephone" type="tel" class="validate" value="<?php $adherent->getTelephone();?>" name="telephone" id="telephone">
            <label for="icon_telephone"><?php echo $adherent->getTelephone();?></label>
          </div>
        </div>
        <div class = "row">
            <label>Je possède mon propre bateau :</label>
              <div class="switch">
                <label>
                  Non
                  <input name ="possede_bateau" value="<?php $adherent->getPossedeBateau();?>" type="checkbox">
                  <span class="lever"></span>
                  Oui
                </label>
              </div>
         </div>
         <div class="row">
            <div class="input-field col s12">
               <textarea id="description" name="description" value="<?php $adherent->getDescription();?>"" class="materialize-textarea"></textarea>
               <label for="description"><?php echo $adherent->getDescription();?> </label>
            </div>
          </div>
        
        <button id="bouton_inscription" type="submit" >Editer mon profil</button>
        
      </form>
    </div>
  </center>