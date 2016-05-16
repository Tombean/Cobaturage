<!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <link rel="stylesheet" href="style_perso.css">
<div class = "navbar-fixed">
        <nav class="#90caf9 blue lighten-3">
          <div class="nav-wrapper" >
            <a href="/adupp/" class="brand-logo">  Cobaturage</a>
            <a href="/adupp/" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
              <li><a href="/adupp/annonces" id='menu_annonces'>Loisirs/Echanges
              </a></li>
              <li><a href="/adupp/achats">Achats/Ventes</a></li>
              <li><a href="/adupp/mesAnnonces">Mes annonces</a></li>
              <li><a href="/adupp/mesAchats">Mes achats / ventes</a></li>
              <li><a href="/adupp/profil">Mon profil</a></li>
              <li><a class="waves-effect waves-light btn" href="/adupp/connexion" id="bouton_connexion" onclick="popup()">Connexion</a></li>
              <li><a class="waves-effect waves-light btn" href="/adupp/deconnexion" id="bouton_deconnexion">Deconnexion</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
              <li><a href="/adupp/annonces">Loisirs/Echanges</a></li>
              <li><a href="/adupp/achats">Achats/Ventes</a></li>
              <li><a href="/adupp/mesAnnonces">Mes annonces</a></li>
              <li><a href="/adupp/mesAchats">Mes achats / ventes</a></li>
              <li><a href="/adupp/profil">Mon profil</a></li>
              <li><a class="waves-effect waves-light btn" href="/adupp/connexion" id="bouton_connexion" onclick="popup()">Connexion</a></li>
              <li><a class="waves-effect waves-light btn" href="/adupp/deconnexion" id="bouton_deconnexion">Deconnexion</a></li>
            </ul>
          </div>
        </nav>
      </div>

      <script type="text/javascript">
        
        function getCookie(name) {
          var dc = document.cookie;
          var prefix = name + "=";
          var begin = dc.indexOf("; " + prefix);
          if (begin == -1) {
              begin = dc.indexOf(prefix);
              if (begin != 0) return null;
          }
          else
          {
              begin += 2;
              var end = document.cookie.indexOf(";", begin);
              if (end == -1) {
              end = dc.length;
              }
          }
          return unescape(dc.substring(begin + prefix.length, end));
        }

        function popup(){
          var myCookie = getCookie("id");
          if (myCookie == null) {
               alert("En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de Cookies pour vous proposer par exemple, un service personnalisé et la création et gestion de vos annonces. Ces Cookies sont automatiquement supprimés après avoir cliqué sur le bouton \"DECONNEXION\" en haut à droite de la page ( ou dans le menu en haut à gauche pour les mobiles & tablettes). ");
          }
        }
      </script>

  