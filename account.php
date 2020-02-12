<?php
include('libs/functions/functions.php');
include('libs/php/db/db_connect.php');
include('libs/functions/selectUserInfos.php');

if (!isConnected()) {
  header('Location: login.php');
  exit;
}

include('libs/functions/selectUserInfos.php');

if ($result["accountStatus"] == 1) {
  header('Location: settings.php?account=checked');
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
    <title>Sporters | Valider son compte</title>
  </head>
  <body>
    <?php include ('libs/php/headers/mainHeader.php'); ?>
    <main>
      <div class="container-fluid filledSection">
        <div class="container">
          <div class="container bg-light filledContainer">
            <form name="profile_form" action="account_validation.php" method="post" enctype="multipart/form-data">
              <div class="form-group col-md-6">
                <!-- Errors display -->
                <?php include('libs/functions/accountValidationErrors.php'); ?>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Pseudo</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text" id="btnGroupAddon">@</div>
                    </div>
                    <input type="text" class="form-control" placeholder="Saisir un pseudo"
                    aria-label="Input group example" aria-describedby="btnGroupAddon"
                    id="pseudo" name="pseudo" value="<?php echo $result["pseudo"]; ?>" readonly>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Adresse Email</label>
                  <input type="text" class="form-control" id="exampleInputEmail1"
                  aria-describedby="emailHelp" placeholder="Saisir l'email" name="email"
                  value="<?php echo $result["email"]; ?>" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputlname">Nom</label>
                  <input type="text" name="lname" class="form-control" id="inputlname"
                  value="<?php echo $result["lastname"]; ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputfname">Prénom</label>
                  <input type="text" name="fname" class="form-control" id="inputfname"
                  value="<?php echo $result["firstname"]; ?>" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputaddr">Adresse</label>
                  <input type="text" name="address" class="form-control" id="inputaddr" placeholder="Saisir une adresse">
                </div>
                <div class="form-group col-md-6">
                  <label for="">Code Postal</label>
                  <input type="text" name="cp" class="form-control" placeholder="Saisir le code postal">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="ville">Ville</label>
                  <input type="text" class="form-control" name="city" id="ville" placeholder="Saisir le nom d'une ville">
                </div>
                <div class="form-group col-md-6">
                  <label for="tel">Téléphone</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text" id="btnGroupAddon">+33</div>
                    </div>
                    <input type="text" class="form-control" name="phone" id="tel" placeholder="Saisir le numéro de téléphone">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="pic">Photo</label>
                  <input type="file" name="profilepic" id="pic" class="form-control-file">
                  <small class="text-muted">La taille maximale est de 200KB.</small>
                </div>
              </div>
              <button type="submit" name="profile_form" class="btn btn-success">Envoyer</button>
            </form>
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
