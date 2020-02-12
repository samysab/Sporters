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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Sporters | Paramètres</title>
  </head>
  <body>
    <?php include('libs/php/headers/mainHeader.php'); ?>
    <main>
      <div class="container-fluid filledSection">
        <div class="container">
          <div class="container bg-light filledContainer">
            <a class="btn btn-success" role="button" href="libs/php/exportUserInfos.php">Exporter les données</a>
            <h1 class="title">Paramètres</h1>
            <hr>
            <div class="row">
              <!-- Display Alerts -->
              <?php include('libs/functions/settingsValidationErrors.php'); ?>
            </div>
            <div class="row">
              <div class="col-md-6">
                <span class="badge badge-pill badge-dark">Informations</span>
              </div>
              <div class="col-md-6">
                <?php include("libs/functions/userSettingsForm.php"); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
