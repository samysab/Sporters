<?php
include('libs/functions/functions.php');
include('libs/php/db/db_connect.php');
include('libs/functions/isVerified.php');

if (!isConnected()) {
  header('Location: login.php');
  exit;
}

isVerified();

if (isset($_GET["delgame"]) && !empty($_GET["delgame"])) {
  $delgame = (int) $_GET["delgame"];
  $deletegame = $conn->prepare('DELETE FROM games WHERE gameId = ?');
  $deletegame->execute(array($delgame));
}

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Sporters | Dashboard</title>

    <!-- Mapbox libs -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' />
    <!-- / Mapbox libs -->
  </head>
  <body>
    <?php include('libs/php/headers/mainHeader.php'); ?>
    <div class="container-fluid">
      <div class="row">
        <?php include('libs/php/headers/dashHeader.php'); ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="container-fluid filledSection">
            <div class="container bg-light filledContainer">
              <!-- Ligne contenant les messages d'erreur -->
              <div class="row">
                <div class="container">
                  <?php include('libs/functions/gameCreationErrors.php'); ?>
                  <?php if (isset($_GET["join"]) && $_GET["join"] == "success") { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Félicitations !</strong> Votre partie est enregistrée !
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                <?php } ?>
                </div>
              </div>
              <!-- Ligne contenant les boutons créer et rejoindre -->
              <div class="row">
                <div class="container">
                  <!-- Inclusion du bouton de création de parties -->
                  <?php include('libs/php/createGameBtn.php'); ?>
                  <?php include('libs/php/joinGameBtn.php'); ?>
                </div>
              </div>
              <hr>
              <!-- Affichage des parties de l'utilisateur -->
              <h1 class="title"><i class="fa fa-calendar"></i> Mes parties créees</h1>
              <div class="accordion" id="accordionExample">
                <?php
                $q = "SELECT * FROM games WHERE users_userId = ?";
                $request = $conn->prepare($q);
                $request->execute([$_SESSION["user"]["userId"]]);
                while($result = $request->fetch()){
                ?>
                <div class="card">
                  <div class="card-header" id="card<?php echo $result["gameId"]; ?>">
                    <h2 class="mb-0">
                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse<?php echo $result["gameId"]; ?>"
                        aria-expanded="true" aria-controls="collapse<?php echo $result["gameId"]; ?>">
                        <?php echo $result["gameName"]; ?>
                      </button>
                    </h2>
                  </div>
                  <div id="collapse<?php echo $result["gameId"]; ?>" class="collapse" aria-labelledby="heading<?php echo $result["gameId"]; ?>"
                    data-parent="#accordionExample">
                    <div class="card-body">
                      <?php include("libs/php/deleteGameBtn.php"); ?>
                      <form>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="dateInput">Date</label>
                            <input type="text" id="dateInput" class="form-control" name="gameDate"
                            value="<?php echo $result["gameDate"]; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="sportInput">Sport</label>
                            <input type="text" id="sportInput" class="form-control" name="gameSport"
                            value="<?php echo $result["gameSport"]; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="slotsInput">Places</label>
                            <input type="text" id="slotsInput" class="form-control" name="gameSlot"
                            value="<?php echo $result["slotAvailable"]; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="fieldInput">Terrain</label>
                            <input type="text" id="fieldInput" class="form-control" name="gameField"
                            value="<?php echo $result["fields_fieldAddress"]; ?>" readonly>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
              <hr>

              <h1 class="title"><i class="fa fa-calendar"></i> Mes parties </h1>
              <div class="accordion" id="accordionExample">
                <?php
                $sql = "SELECT games_gameId, gameId, gameName, gameDate, gameSport, slotAvailable, fields_fieldAddress FROM games_history INNER JOIN games ON games_history.games_gameId = games.gameId WHERE games_history.users_userId = ?";
                $req = $conn->prepare($sql);
                $req->execute([$_SESSION["user"]["userId"]]);
                while($res = $req->fetch()){
                ?>
                <div class="card">
                  <div class="card-header" id="card<?php echo $res["gameId"]; ?>">
                    <h2 class="mb-0">
                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse<?php echo $res["gameId"]; ?>"
                        aria-expanded="true" aria-controls="collapse<?php echo $res["gameId"]; ?>">
                        <?php echo $res["gameName"]; ?>
                      </button>
                    </h2>
                  </div>
                  <div id="collapse<?php echo $res["gameId"]; ?>" class="collapse" aria-labelledby="heading<?php echo $res["gameId"]; ?>"
                    data-parent="#accordionExample">
                    <div class="card-body">
                      <?php include("libs/php/deleteGameBtn.php"); ?>
                      <form>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="dateInput">Date</label>
                            <input type="text" id="dateInput" class="form-control" name="gameDate"
                            value="<?php echo $res["gameDate"]; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="sportInput">Sport</label>
                            <input type="text" id="sportInput" class="form-control" name="gameSport"
                            value="<?php echo $res["gameSport"]; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="slotsInput">Places</label>
                            <input type="text" id="slotsInput" class="form-control" name="gameSlot"
                            value="<?php echo $res["slotAvailable"]; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="fieldInput">Terrain</label>
                            <input type="text" id="fieldInput" class="form-control" name="gameField"
                            value="<?php echo $result["fields_fieldAddress"]; ?>" readonly>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>

            </div>
          </div>
        </main>
      </div>
    </div>
    <script>


      // Les points clés de ce code:
      // 1. On fait d'abord une requete ajax à l'API de Mapbox (API = interface/passerelle entre nos clients et leurs ressources)
      // pour afficher un marker sur les coordonnées longitude/latitude depuis l'adresse postale de l'user
      // 2. si ça marche, on va faire une requete a la bdd pour obtenir toutes les parties dans un tableau
      // on va ensuite afficher les markers sur la map, les fichiers icons sur le serveur sont pour l'instant entrés en dur dans
      // /ressources/images/icons_map/ mais je vais rajouter un moyen de les mettre Quand on cree un terrrain (donc sport)
      // 3. dans la continuité, on crée nos popups qu'on va relier à nos markers, et on ajoute tout à la map

      let xhttp = new XMLHttpRequest();

      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4) {
          // res = reponse de l'api en notation JSON (JavaScript Object Notation, JSON = notation object en javascript)
          let res = JSON.parse(this.responseText);

          // on cree la map qu'on centre sur lui (il n'y pas pas de marker pour l'instant c'est juste centré sur lui)
          let latLng = res.features[0].center;

          mapboxgl.accessToken = 'pk.eyJ1IjoicmVrbmEiLCJhIjoiY2p1OXhseWZmMmN6MzN5dGE1OXR3d2w5YSJ9.quIazYXCP40KtNDwjOoHeg';

          var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [latLng[0], latLng[1]],
            zoom: 13
          });

          // on ajoute les controls
          map.addControl(new mapboxgl.NavigationControl());

          // on cree le marker Utilisateur
          var userMarker = document.createElement('div');
          // pour qu'il y est sa photo de profil en marker, on met l'url via la sessoin
          userMarker.style.backgroundImage = "url(<?php echo $_SESSION['user']['userProfilePic']; ?>)";
          userMarker.style.backgroundSize = "90% 90%";
          userMarker.style.backgroundPosition = "center";
          userMarker.style.backgroundRepeat = "no-repeat";
          userMarker.style.backgroundColor = "white";
          userMarker.style.borderRadius = "100%";
          userMarker.style.border = "2px solid grey";
          userMarker.style.width = "40px";
          userMarker.style.height = "40px";

          // on ajoute le marker aux coordonnes renvoyées au debut par la requete ajax et on ajoute a la map
          new mapboxgl.Marker(userMarker).setLngLat(latLng).addTo(map);


          // ####### a bien noter que c'est une fonction pas un code procedural qui se fait 1 fois et salut ######
          // le but de la fonction addGame est :
          // ## 1 ##. récupérer les coordonnees lat/lng via une requete ajax à l'api mapbox avec en parametre
          //            => fieldAddress
          //            => fieldPostalCode
          // ca renvoie un long res en JSON, on parse le JSON pour l'avoir en javascript standard sous forme de tableau
          // et on recupere dans latLng le tableau [latitude, longitude]
          // ## 2 ## on va préparer: le marker (a), designer le popup (b), et les ajouter (c)
          function addGame(address, sport, game) {
            let xhttpGame = new XMLHttpRequest;
            xhttpGame.onreadystatechange = function() {
              let res = JSON.parse(this.responseText);

              let latLng = res.features[0].center;

              // (a)
              var gameMarker = document.createElement('div');
              gameMarker.style.backgroundImage = "url(ressources/images/icons_map/" + sport + ".svg)";
              gameMarker.style.backgroundSize = "100% 100%";
              gameMarker.style.backgroundPosition = "center";
              gameMarker.style.backgroundRepeat = "no-repeat";
              gameMarker.style.borderRadius = "100%";
              gameMarker.style.width = "40px";
              gameMarker.style.height = "40px";


              // (b)
              var partie = game;
              var container = document.createElement('div');
              container.setAttribute('style', 'text-align: center; width: 200px; margin: 0px auto;');

              // Titre
              var h1 = document.createElement('h4');
              h1.innerHTML = game['gameName'];

              // Places dispos
              var placesDispo = document.createElement('p');
              placesDispo.innerHTML = "Places dispos : " + game['slotAvailable'];


              // Le : JJ / MM
              var gameDate = game['gameDate'].split("-");
              var gd_day = gameDate[2];
              var gd_month = gameDate[1];
              var jourdejeu = document.createElement('p');
              jourdejeu.innerHTML = "Le : " + gd_day + " / " + gd_month;

              // Boutton Rejoindre
              var joinLink = document.createElement('a');
              joinLink.setAttribute('href', 'libs/php/joinGame.php?gameId=' + game['gameId'] + "&userId=" + <?php echo $_SESSION['user']['userId']; ?>);

              var joinButton = document.createElement('button');
              joinButton.setAttribute('class', 'btn btn-primary');
              joinButton.innerHTML = "Rejoindre";
              joinLink.appendChild(joinButton);


              // On construit
              container.appendChild(h1);
              container.appendChild(jourdejeu);
              container.appendChild(placesDispo);
              container.appendChild(joinLink);


              // (c)
              var popup = new mapboxgl.Popup({offset: 25})
              .setDOMContent(container);

              new mapboxgl.Marker(gameMarker)
              .setLngLat(latLng)
              .setPopup(popup)
              .addTo(map);


            }

            // on passe en parametre de la requete à l'API de mapbox le fieldAdress concaténé avec le postalCode
            // en fait l'api demande une adresse et renvoie des coordonnees GPS
            xhttpGame.open('GET', 'https://api.mapbox.com/geocoding/v5/mapbox.places/' + address + '.json?access_token=pk.eyJ1IjoicmVrbmEiLCJhIjoiY2p1OXhseWZmMmN6MzN5dGE1OXR3d2w5YSJ9.quIazYXCP40KtNDwjOoHeg&language=french', true);
            xhttpGame.send();
          }

          <?php

          $queryParties = $conn->prepare('SELECT * FROM games');
          $queryParties->execute();

          $partiesTab = $queryParties->fetchAll();

          foreach ($partiesTab as $partie) {
            $getPostalCodeCity = $conn->prepare('SELECT fieldPostalCode FROM fields WHERE fieldAddress = ?');
            $getPostalCodeCity->execute([$partie['fields_fieldAddress']]);
            $res = $getPostalCodeCity->fetch();
            ?>

            // on passe donc l'adresse en parametre pour recup les coordonnees GPS,
            // le type de sport de la partie pour y mettre le bon icon du marker
            // et les details de la partie exemple: {"gameId": 2, "gameName", "Partie de basket" ...}
            // ces details on les recupere pour afficher dans les document.createElement
            // le rose a la fin est normal
            addGame("<?php echo $partie['fields_fieldAddress'] . ' ' . $res[0] . '", "' . strtolower($partie['gameSport']) . '", ' . json_encode($partie); ?>);

          <?php } ?>

        }
      }

      xhttp.open('GET', 'https://api.mapbox.com/geocoding/v5/mapbox.places/<?php echo $_SESSION['user']['userAddress'] . '%20' . $_SESSION['user']['postalCode'] . '%20' . $_SESSION['user']['city']; ?>.json?access_token=pk.eyJ1IjoicmVrbmEiLCJhIjoiY2p1OXhseWZmMmN6MzN5dGE1OXR3d2w5YSJ9.quIazYXCP40KtNDwjOoHeg&language=french', true);
      xhttp.send();

    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
