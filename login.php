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
    <title>Sporters | Connexion</title>
  </head>
  <body>
    <?php include ('libs/php/headers/mainHeader.php'); ?>
    <main>
      <div class="container-fluid filledSection">
        <div class="container bg-light filledContainer">
          <form name="login_form" method="post" action="libs/php/connexion.php">
            <img class="icon" src="ressources/images/login.png" alt="sporters_login">
            <div class="form-group col-md-6">
              <?php if (isset($_GET['login']) && $_GET['login'] == "loginerror") {
                echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">Email ou mot de passe incorrect</div>';
              }
              if (isset($_GET['login']) && $_GET['login'] == "field_blank") {
                echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">Tous les champs doivent être remplis !</div>';
              }

              if (isset($_GET['account']) && $_GET['account'] == 'confirmed') { ?>
                <div class="alert text-center alert-success" role="alert">
                  Compte enregistré avec succès ! Connectez-vous pour le valider
                </div>
                <?php } else if (isset($_GET['error']) && $_GET['error'] == 'banned') { ?>
                <div class="alert text-center alert-danger" role="alert">
                  Vous avez été banni ! Si vous pensez que c'est une erreur, veuillez nous contacter
                </div>
                <?php } ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Adresse Email</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Saisir l'email" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Mot de passe</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Saisir un mot de passe" name="mdp">
            </div>
            <button type="submit" name="formconnexion" class="btn btn-primary">Se connecter</button>
            <a href="signup.php"><p>Pas encore inscrit ? Rejoingnez-nous !</p></a>
          </form>
        </div>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
