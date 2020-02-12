<?php
  include('../libs/php/db/db_connect.php');
  include('functions/functions.php');
  hasAccess();

  if(isset($_GET['supprimer']) AND !empty($_GET['supprimer'])) {
      $supprimer = (int) $_GET['supprimer'];
      $req = $conn->prepare('DELETE FROM fields WHERE fieldId = ?');
      $req->execute(array($supprimer));
   }
   if(isset($_GET['modifier']) AND !empty($_GET['modifier'])) {
     $modifier = (int) $_GET['modifier'];
     $req = $conn->prepare('SELECT * FROM fields WHERE fieldId = ?');
     $req->execute(array($modifier));
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styleViewUsers.css">

    <title>Administration</title>
  </head>
  <body>
    <?php include('../libs/php/headers/admDashHeader.php'); ?>
    <br>
    <div class="container-fluid filledSection">
      <div class="container bg-light filledContainer">
        <h1 class="title">Les terrains :</h1>
        <hr>
        <p><button type="button" class="btn btn-outline-success" onclick="window.location.href = 'addField.php'">Ajouter un terrain</button></p>
        <div class="row">
              <?php
                $show = $conn->query('SELECT * FROM fields');
                while ($m = $show->fetch()){
              ?>
              <div  class="col-md-4">
                <div class="card" style="width: 18rem;">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $m["fieldName"] . " " . $m["fieldSport"]; ?></h5>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">ID : <?php echo $m['fieldId']; ?></li>
                      <li class="list-group-item">Nom : <?php echo $m['fieldName']; ?></li>
                      <li class="list-group-item">Adresse : <?php echo $m['fieldAddress']; ?></li>
                      <li class="list-group-item">Code Postal : <?php echo $m['fieldPostalCode']; ?></li>
                      <li class="list-group-item">Sports : <?php echo $m['fieldSport']; ?></li>
                    </ul>
                    <a class="btn btn-primary" id="ban" role="button" href="viewFields.php?supprimer=<?= $m['fieldId'] ?>">supprimer</a>
                    <a class="btn btn-primary" id="modifier" role="button" href="modifField.php?modifier=<?= $m['fieldId'] ?>">modifier</a>
                  </div>
                </div>
              </div>
            <?php } ?>

        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
