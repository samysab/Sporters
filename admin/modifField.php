<?php
include('../libs/php/db/db_connect.php');
include('../libs/functions/functions.php');
  if (isConnected()) {
    header('Location: dashboard.php');
  }

$req = $conn->prepare('SELECT * FROM fields WHERE fieldId = ?');
$req->execute(array($_GET['modifier']));

$res = $req->fetch();
if (isset($_POST['changeButton'])) {

  $nameLength = strlen($_POST['name']);
  if ($nameLength > 45) {
    header('location: modifField.php?modifier='. $_GET['modifier']. '&error=name_to_long');
    exit;
  }
  $sportLength = strlen($_POST['sport']);
  if ($sportLength > 45) {
    header('location: modifField.php?modifier='. $_GET['modifier']. '&error=sport_to_long');
    exit;
  }
  $adresseLength = strlen($_POST['adresse']);
  if ($adresseLength > 45) {
    header('location: modifField.php?modifier='. $_GET['modifier']. '&error=address_to_long');
    exit;
  }
  $codePostalLength = strlen($_POST['codePostal']);
  if ($codePostalLength > 5) {
    header('location: modifField.php?modifier='. $_GET['modifier']. '&error=codePostal_to_long');
    exit;
  }
  $pattern = "#[^0-9]#";
  if (preg_match($pattern, $_POST['codePostal'])) {
    header('location: modifField.php?modifier='. $_GET['modifier']. '&error=codePostal_to_long');
    exit;
  }
  $pattern = "#[0-9]#";
  if (preg_match($pattern, $_POST['sport'])) {
    header('location: modifField.php?modifier='. $_GET['modifier']. '&error=numeric_sport');
    exit;
  }
  if (preg_match($pattern, $_POST['name'])) {
    header('location: modifField.php?modifier='. $_GET['modifier']. '&error=numeric_name');
    exit;
  }
$req = $conn->prepare('UPDATE fields SET 	fieldAddress = ?, 	fieldName = ?, 	fieldPostalCode = ?, 	fieldSport = ? WHERE fieldId= ?');
  $req->execute(array(
  $_POST['adresse'],
  $_POST['name'],
  $_POST['codePostal'],
  $_POST['sport'],
  $_GET['modifier']
  ));
  header('location: modifField.php?modifier='. $_GET['modifier']. '&error=modifField');

}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Sporters</title>
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
                if(isset($_GET['error']) AND $_GET['error']=='name_to_long'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le nom ne peut pas dépasser 45 caracteres !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='sport_to_long'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le sport ne peut pas dépasser 45 caracteres !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='numeric_sport'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le sport ne peut pas contenir de chiffre !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='numeric_name'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le nom du terrain ne peut pas contenir de chiffre !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='address_to_long'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'L\'adresse ne peut pas dépasser 45 caracteres !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='codePostal_to_long'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le code postal ne peut pas dépasser 5 caracteres !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='modifField'){
                  echo '<div class="alert alert-success col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le terrain a bien été modifier !'. '</div>';
                }
                ?>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Nom du terrain</label>
                <input type="text" class="form-control"  aria-describedby="emailHelp"  id="name" name="name" value="<?php echo $res[2]; ?>">
              </div>
              <div class="form-group col-md-6">
                <label>Sport</label>
                <div class="input-group">
                  <input type="text" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon" id="sport" name="sport" value="<?php echo $res[4]; ?>">
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Adresse </label>
                  <input type="text" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon" id="adresse" name="adresse" value="<?php echo $res[1]; ?>">
                </div>
                <div class="form-group col-md-6">
                  <label>Code postal</label>
                    <input type="text" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon" id="codePostal" name="codePostal" value="<?php echo $res[3]; ?>">
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
