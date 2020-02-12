<?php
include('../libs/php/db/db_connect.php');
include('../libs/functions/functions.php');
  if (isConnected()) {
    header('Location: dashboard.php');
  }

$req = $conn->prepare('SELECT * FROM games WHERE gameId = ?');
$req->execute(array($_GET['modifier']));

$res = $req->fetch();
if (isset($_POST['changeButton'])) {
  $gamenameLength = strlen($_POST['gameName']);
  if ($gamenameLength > 45) {
    header('location: modifGame.php?modifier='.$_GET['modifier']. '&error=gamename_to_long');
    exit;
  }
  $sportLenth = strlen($_POST['gameSport']);
  if ($sportLenth > 45) {
    header('location: modifGame.php?modifier='.$_GET['modifier']. '&error=sport_to_long');
    exit;
  }

  if (isset($_POST['fieldId']) && $_POST['fieldId']== '--Nom du terrain--') {
    header('location: modifGame.php?modifier='.$_GET['modifier']. '&error=complexe_selected');
    exit;
    }

  $req_fieldID = 'SELECT fieldAddress FROM fields WHERE fieldId = ?';
  $reqet = $conn->prepare($req_fieldID);
  $reqet->execute(array($_POST['fieldId']));
  $address = $reqet->fetch();
  $req = $conn->prepare('UPDATE games SET gameName = ?, 	slotAvailable = ?, gameSport = ?,gameDate = ?, fields_fieldAddress = ?, fields_fieldId = ?  WHERE gameId= ?');

  $req->execute(array(
    $_POST['gameName'],
    $_POST['slotAvailable'],
    $_POST['gameSport'],
    $_POST['gameDate'],
    $address[0],
    $_POST['fieldId'],
    $_GET['modifier']
  ));
  header('location: modifGame.php?modifier='.$_GET['modifier']. '&error=addGame');
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="/sporters/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Sporters</title>
</head>
  <body>
    <?php
 include('../libs/php/headers/admDashHeader.php'); ?>
    <main>
      <div class="container-fluid filledSection">
        <div class="container bg-light filledContainer">
          <form name="signup_form" method="post" action="">
            <div class="form-row">
              <div class="form-group col-md-6">
                <img class="icon" src="/sporters/ressources/images/sporters_form_icon.png" alt="sporters_form_icon">
              </div>
              <div class="form-group col-md-6">
                <?php
                if(isset($_GET['error']) AND $_GET['error']=='gamename_to_long'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le nom ne peut pas dépasser 45 caracteres !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='sport_to_long'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le nom du sport ne peut pas dépasser 45 caracteres !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='addGame'){
                  echo '<div class="alert alert-success col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Information modifié !'. '</div>';
                }
                if(isset($_GET['error']) AND $_GET['error']=='complexe_selected'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Vous devez sélectionner un terrain  !'. '</div>';
                }

                ?>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Nom</label>
                <input type="text" class="form-control"  aria-describedby="emailHelp"  id="gameName" name="gameName" value="<?php echo $res[1]; ?>">
              </div>
              <div class="form-group col-md-6">
                <label>Joueurs Max</label>
                <div class="input-group">
                  <input type="number" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon" id="slotAvailable" name="slotAvailable" value="<?php echo $res[4]; ?>">
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label> Sport </label>
                  <input type="text" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon" id="gameSport" name="gameSport" value="<?php echo $res[3]; ?>">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Date</label>
                  <input type="date" class="form-control"  aria-describedby="emailHelp"  id="gameDate" name="gameDate" value="<?php echo $res[2]; ?>">
                </div>
                <div class="form-group col-md-6">
                  <label>Nom du complexe</label>
                  <div class="input-group">
                    <select id="fieldId" name="fieldId">
                      <option>--Nom du terrain--</option>
                      <?php
                      $showField = $conn->query('SELECT * FROM fields');
                      while ($m = $showField->fetch()){
                        echo '<option value="'. $m['fieldId'].'">'. $m['fieldAddress']. '</option>';                                  //MAYDAY RECUPERER LADRESSE DU TERRAIN POUR UPDATE LA BDD
                      }
                       ?>

                      </select>
                  </div>
                </div>
              </div>
                <input type="submit" class="btn btn-primary" name="changeButton" value="Mettre à jour">
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
