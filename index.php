<?php
include('libs/functions/functions.php');
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Sporters</title>
  </head>
  <body>
    <?php include ('libs/php/headers/mainHeader.php'); ?>
    <?php

    if (isset($_GET['inscription']) && $_GET['inscription'] == 'success') { ?>
      <div class="alert text-center alert-success" role="alert">
        Inscription réussie ! Nous vous avons envoyé un mail pour confirmer votre compte
      </div>
    <?php } ?>
    <main>
      <div class="container-fluid emptyIndexSection">
        <div class="transparentContainer">
          <h1 id="logotext">Sporters</h1>
          <p class="sublogotext">Trouvez une partie ou un terrain près de chez vous</p>
          <p class="sublogotext">L'inscription est gratuite !</p>
          <div class="actions">
            <a role="button" class="btn btn-success" href="signup.php">Inscription</a>
            <a role="button" class="btn btn-light" href="login.php">Connexion</a>
          </div>
        </div>
      </div>
      <div class="container-fluid filledSection bg-light">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
              <div class="jumbotron">
                <h1 class="display-4">Bienvenue !</h1>
                <p class="lead"><b>Sporters</b> est une plateforme qui vous permet
                  de rechercher une partie de foot, basket et plein d'autres sports près de chez vous.
                </p>
                <hr class="my-4">
                <p>Pour trouver une partie, des joueurs et des terrains en fonction des sports pratiqués,
                  <b>l'inscription est gratuite</b> alors profitez en !
                </p>
                <a class="btn btn-success btn-lg" href="signup.php" role="button">Decouvrir</a>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
              <div class="jumbotron jumboDark bg-dark">
                <h1 class="display-4">Events</h1>
                <p class="lead"><b>Sporters</b> vous permet aussi
                  d'organiser des events (tournois payants).
                </p>
                <hr class="my-4">
                <p>Cette fonctionnalité est réservée aux membres ayant un statut "Manager",
                  <b>l'inscription est payante</b>, pour en savoir plus cliquez sur le bouton ci-dessous.
                </p>
                <a class="btn btn-success btn-lg" href="signup.php" role="button">Inscription</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php include ('libs/php/footers/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
