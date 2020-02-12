<?php
include('libs/functions/functions.php');
include('libs/php/db/db_connect.php');
include('libs/functions/selectUserInfos.php');


if (!isConnected()) {
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
            <div class="container">
              <div class="row">
                <div class="container bg-light filledContainer">
                  <!-- Account Status Alert -->
                  <?php if ($result["accountStatus"] == 0) { ?>
                    <div class="alert alert-danger" role="alert">
                      Vous devez <a href="account.php">valider</a> votre compte pour accéder à plus de fonctionnalités.
                    </div>
                  <?php } else {
                    $updateUser = $conn->prepare('SELECT * FROM users WHERE userId = ?');
                    $updateUser->execute([$_SESSION['user']['userId']]);
                    $user = $updateUser->fetch();
                    $_SESSION['user'] = $user;
                  }

                  if (isset($_GET['account']) && $_GET['account'] == 'premium') { ?>
                    <div class="alert alert-success" role="alert">
                      Vous êtes maintenant membre Premium ! Organisez autant de tournois que vous souhaitez
                    </div>
                  <?php } ?>

                  <!-- map -->
                  <div id='map' style='width: 100%; height: 400px;'></div>
                  <!-- end map -->
                </div>
              </div>

          </div>
        </main>
      </div>
    </div>


    <?php

    if ($_SESSION['user']['accountStatus'] == 1) { ?>

      <script>


        // Les points clés de ce code:
        // 1. On fait d'abord une requete ajax à l'API de Mapbox (API = interface/passerelle entre nos clients et leurs ressources)
        // pour afficher un marker sur les coordonnées longitude/latitude depuis l'adresse postale de l'user
        // 2. si ça marche, on va faire une requete a la bdd pour obtenir toutes les Fields dans un tableau
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
            function addField(address, sport, field) {
              let xhttpField = new XMLHttpRequest;
              xhttpField.onreadystatechange = function() {
                let res = JSON.parse(this.responseText);

                let latLng = res.features[0].center;

                // (a)
                var fieldMarker = document.createElement('div');
                fieldMarker.style.backgroundImage = "url(ressources/images/icons_map/" + sport + ".svg)";
                fieldMarker.style.backgroundSize = "100% 100%";
                fieldMarker.style.backgroundPosition = "center";
                fieldMarker.style.backgroundRepeat = "no-repeat";
                fieldMarker.style.borderRadius = "100%";
                fieldMarker.style.width = "40px";
                fieldMarker.style.height = "40px";


                // (b)
                var container = document.createElement('div');
                container.setAttribute('style', 'text-align: center; width: 200px; margin: 0px auto;');

                // Titre
                var h1 = document.createElement('h4');
                h1.innerHTML = field["fieldName"];
                // Places dispos
                var placesDispo = document.createElement('p');
                // placesDispo.innerHTML = "Places dispos : " + field['slotAvailable'];



                // On construit
                container.appendChild(h1);


                // (c)
                var popup = new mapboxgl.Popup({offset: 25})
                .setDOMContent(container);

                new mapboxgl.Marker(fieldMarker)
                .setLngLat(latLng)
                .setPopup(popup)
                .addTo(map);


              }

              // on passe en parametre de la requete à l'API de mapbox le fieldAdress concaténé avec le postalCode
              // en fait l'api demande une adresse et renvoie des coordonnees GPS
              xhttpField.open('GET', 'https://api.mapbox.com/geocoding/v5/mapbox.places/' + address + '.json?access_token=pk.eyJ1IjoicmVrbmEiLCJhIjoiY2p1OXhseWZmMmN6MzN5dGE1OXR3d2w5YSJ9.quIazYXCP40KtNDwjOoHeg&language=french', true);
              xhttpField.send();
            }

            <?php
            
            $queryFields = $conn->prepare('SELECT * FROM fields');
            $queryFields->execute();

            $FieldsTab = $queryFields->fetchAll();


            foreach ($FieldsTab as $field) {
              ?>

              addField("<?php echo $field['fieldAddress'] . ' ' . $field['fieldPostalCode'] . '", "' . strtolower($field['fieldSport']) . '", ' . json_encode($field); ?>);


            <?php } ?>

          }
        }

        xhttp.open('GET', 'https://api.mapbox.com/geocoding/v5/mapbox.places/<?php echo $_SESSION['user']['userAddress'] . '%20' . $_SESSION['user']['postalCode'] . '%20' . $_SESSION['user']['city']; ?>.json?access_token=pk.eyJ1IjoicmVrbmEiLCJhIjoiY2p1OXhseWZmMmN6MzN5dGE1OXR3d2w5YSJ9.quIazYXCP40KtNDwjOoHeg&language=french', true);
        xhttp.send();

      </script>

     <?php } else { ?>
      <script>
        document.getElementById('map').classList.add('text-center');
        document.getElementById('map').style.background = 'linear-gradient(#999999, #e6e6e6)';
        document.getElementById('map').innerHTML = '<div class="alert w-50 text-center alert-danger" style="margin: 0px auto" role="alert">Ajoutez votre adresse pour découvrir la map interactive !</div>';
      </script>
     <?php } ?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
