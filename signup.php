<?php

include('libs/functions/functions.php');
  if (isConnected()) {
    header('Location: dashboard.php');
  }
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Sporters | Inscription</title>
  </head>
  <body>
    <?php include('libs/php/headers/mainHeader.php'); ?>
    <main>
      <div class="container-fluid filledSection">
        <div class="container bg-light filledContainer">
          <form name="signup_form" method="post" action="libs/php/inscription.php">
            <div class="form-row">
              <div class="form-group col-md-6">
                <img class="icon" src="ressources/images/sporters_form_icon.png" alt="sporters_form_icon">
              </div>
              <div class="form-group col-md-6">
                <?php if (isset($_GET['signup']) && $_GET['signup'] == "passerror") {
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Vos mot de passe ne correspondent pas !'. '</div>';
                }
                if (isset($_GET['signup']) && $_GET['signup'] == "pseudolength") {
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Votre pseudo ne peut pas dépasser 15 caracteres !'. '</div>';
                }
                if (isset($_GET['signup']) && $_GET['signup'] == "lastname_length") {
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Votre nom ne peut pas dépasser 15 caracteres !'. '</div>';
                }
                if (isset($_GET['signup']) && $_GET['signup'] == "field_blank") {
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Tout les champs doivent être compléter !'. '</div>';
                }
                if (isset($_GET['signup']) && $_GET['signup'] == "name_length") {
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Votre prénom ne peut pas dépasser 15 caracteres !'. '</div>';
                }
                if (isset($_GET['signup']) && $_GET['signup'] == "invalid_email") {
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Votre adresse mail n\'est pas valide ! '. '</div>';
                }

                if (isset($_GET['signup']) && $_GET['signup'] == "invalid_captcha") {
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le Captcha est invalide ! Réessayer...'. '</div>';     //captcha
                }
                if (isset($_GET['error']) && $_GET['error'] == "email_exist") {
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Email déja existant'. '</div>';     //captcha
                }
                ?>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Adresse Email</label>
                <input  type="email" class="form-control"  aria-describedby="emailHelp" placeholder="Saisir l'Email" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>">
                <small id="emailHelp" class="form-text text-muted">Vos informations resteront confidentielles.</small>
              </div>
              <div class="form-group col-md-6">
                <label>Pseudo</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text" id="btnGroupAddon">@</div>
                  </div>
                  <input type="text" class="form-control" placeholder="Saisir un pseudo" aria-label="Input group example" aria-describedby="btnGroupAddon" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>">
                </div>
                <small class="form-text text-muted">Soyez original !</small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Mot de passe</label>
                <input type="password" class="form-control" id="mdp" name="mdp" onkeypress="verif_mdp()" placeholder="Saisir un mot de passe">
                <canvas id="canvas" width="545" height="20"></canvas>
                <small class="form-text text-muted">Le mot de passe doit contenir au moins 8 caractères dont des chiffres et des caractères spéciaux.</small>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Confirmation du mot de passe</label>
                <input  type="password" class="form-control" id="mdp2" name="mdp2" placeholder="Resaisir le mot de passe">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Nom</label>
                <input type="text" class="form-control" placeholder="Nom" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>">
                <small class="form-text text-muted">Le nom doit contenir au moins 2 caractères.</small>
              </div>
              <div class="form-group col-md-6">
                <label for="formPrenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom"  placeholder="Prénom" value="<?php if(isset($_POST['prenom']))echo $_POST['prenom'];?>">
                <small class="form-text text-muted">Le prénom doit contenir au moins 2 caractères.</small>
              </div>
            </div>
            <div class="form-group form-check">
              <input name="rules" type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">J'accepte les <a href="cgu.php">conditions générales d'utilisation</a>.</label>
            </div>

             <img src="libs/php/captcha.php" />                                                            <!-- captcha-->
            <input type="text" name="captcha" placeholder="Captcha*">                                                            <!-- captcha-->
              <br><br>
            <button type="submit" name="forminscription" class="btn btn-primary ">S'inscrire</button>                                                            <!-- captcha-->
            <a href="login.php"><p>Déjà inscrit ? Se connecter</p></a>
          </form>
        </div>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="libs/functions/canvas.js" charset="utf-8"></script>
  </body>
</html>
