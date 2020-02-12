<?php
include('../libs/php/db/db_connect.php');
include('../libs/functions/functions.php');
  if (isConnected()) {
    header('Location: dashboard.php');
  }

$req = $conn->prepare('SELECT * FROM users WHERE userId = ?');
$req->execute(array($_GET['modifier']));

$res = $req->fetch();
if (isset($_POST['changeButton'])) {

  $emaillength = strlen($_POST['email']);
  if ($emaillength > 45) {
    header('location: modifuser.php?modifier='.$_GET['modifier']. '&error=email_to_long');
    exit;
  }
  $pseudolength = strlen($_POST['pseudo']);
  if ($pseudolength > 15) {
    header('location: modifuser.php?modifier='.$_GET['modifier']. '&error=pseudo_to_long');
    exit;
  }
  $userAddressLength = strlen($_POST['userAddress']);
  if ($userAddressLength > 45) {
    header('location: modifuser.php?modifier='.$_GET['modifier']. '&error=address_to_long');
    exit;
  }
  $firstnameLength = strlen($_POST['firstname']);
  if ($firstnameLength > 45) {
    header('location: modifuser.php?modifier='.$_GET['modifier'].'&error=firstname_to_name');
    exit;
  }
  $lastnameLength = strlen($_POST['lastname']);
  if ($lastnameLength > 45) {
    header('location: modifuser.php?modifier='. $_GET['modifier']. '&error=lastname_to_long');
    exit;
  }
  $cityLength = strlen($_POST['city']);
  if ($cityLength > 45) {
    header('location: modifuser.php?modifier='. $_GET['modifier']. '&error=city_to_long');
    exit;
  }
  // Vérification de la taille et format de données saisies champs ville
  $pattern = "#[^0-9]#";
  if (preg_match($pattern, $_POST["city"])) {
    header('Location: modifuser.php?modifier='. $_GET['modifier']. '&error=city_format');
    exit;
  }
  if (preg_match($pattern, $_POST["firstname"])) {
    header('Location: modifuser.php?modifier='. $_GET['modifier']. '&error=firstname_format');
    exit;
  }
  if (preg_match($pattern, $_POST["lastname"])) {
    header('Location: modifuser.php?modifier='. $_GET['modifier']. '&error=lastname_format');
    exit;
  }

  $req = $conn->prepare('UPDATE users SET email = ?, pseudo = ?, firstname = ?, lastname = ?, userAddress = ?, city = ? WHERE userId= ?');
  $req->execute(array(
    $_POST['email'],
    $_POST['pseudo'],
    $_POST['firstname'],
    $_POST['lastname'],
    $_POST['userAddress'],
    $_POST['city'],
    $_GET['modifier']
  ));
  header('Location: modifuser.php?modifier='. $_GET['modifier']. '&error=good');

}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Modification de l'utilisateur</title>
</head>
  <body>
    <?php include('../libs/php/headers/admDashHeader.php'); ?>
    <main>
      <div class="container-fluid filledSection">
        <div class="container bg-light filledContainer">
          <form name="signup_form" method="post" action="">
            <div class="form-row">
              <div class="form-group col-md-6">
                <img class="icon" src="../ressources/images/sporters_form_icon.png" alt="sporters_form_icon">
              </div>  
              <div class="form-group col-md-6">
                <?php
                if(isset($_GET['error']) AND $_GET['error']=='email_to_long'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'L\'adresse mail ne peut pas dépasser 45 caracteres !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='pseudo_to_long'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le pseudo ne peut pas dépasser 15 caracteres !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='address_to_long'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'l\'adresse ne peut pas dépasser 255 caracteres !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='firstname_to_name'){
                echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le prenom ne peut pas dépasser 45 caracteres !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='lastname_to_long'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le nom de famille ne peut pas dépasser 45 caracteres !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='city_to_long'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'La ville ne peut pas dépasser 45 caracteres !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='city_format'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'La ville ne peut pas avoir de chiffre !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='lastname_format'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le nom de famille ne peut pas avoir de chiffre !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='firstname_format'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le prenom ne peut pas avoir de chiffre !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='good'){
                  echo '<div class="alert alert-success col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Les informations ont été modifier !'. '</div>';
                }

                ?>
                
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Pseudo</label>
                <input type="text" class="form-control"  aria-describedby="emailHelp"  id="pseudo" name="pseudo" value="<?php echo $res[2]; ?>">
              </div>
              <div class="form-group col-md-6">
                <label>email</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text" id="btnGroupAddon">@</div>
                  </div>
                  <input type="text" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon" id="email" name="email" value="<?php echo $res[1]; ?>">
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Prenom </label>
                  <input type="text" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon" id="firstname" name="firstname" value="<?php echo $res[4]; ?>">
                </div>
                <div class="form-group col-md-6">
                  <label>Nom de famille </label>
                    <input type="text" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon" id="lastname" name="lastname" value="<?php echo $res[5]; ?>">
                  </div>
              </div>
              
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Adresse </label>
                    <input type="text" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon" id="userAddress" name="userAddress" value="<?php echo $res[6]; ?>">
                </div>
                  <div class="form-group col-md-6">
                    <label>ville </label>
                      <input type="text" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon" id="city" name="city" value="<?php echo $res[9]; ?>">
                  </div>
                  <input type="submit" class="btn btn-primary" name="changeButton" value="Mettre à jour">
              </div>
            </div>
          </form>
        </div>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
