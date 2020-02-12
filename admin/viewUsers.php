<?php
  include('functions/functions.php');
  hasAccess();
  include('../libs/php/db/db_connect.php');


  if(isset($_GET['bannir']) AND !empty($_GET['bannir'])) {
      $bannir = (int) $_GET['bannir'];
      $req = $conn->prepare('DELETE FROM users WHERE userId = ?');
      $req->execute(array($bannir));
   }
   if(isset($_GET['modifier']) AND !empty($_GET['modifier'])) {
     $modifier = (int) $_GET['modifier'];
     $req = $conn->prepare('SELECT * FROM users WHERE userId = ?');
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
        <h1 class="title">Les utilisateurs :</h1>
        <div class="container">
          <a class="btn btn-success" role="button" href="../libs/php/export.php">Exporter les données</a>
        </div>
        <div class="row">
          <?php

              $show = $conn->query('SELECT * FROM users');

              while ($m = $show->fetch()) { ?>

            <div  class="col-md-4">
              <div class="container">
                <div class="card" style="width: 18rem;">
                  <img src="../<?php echo $m["userProfilePic"]; ?>" class="card-img-top" alt="photo_profil">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $m["firstname"] . " " . $m["lastname"]; ?></h5>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Pseudo : <?php echo $m['pseudo']; ?></li>
                      <li class="list-group-item">Email : <?php echo $m['email']; ?></li>
                      <li class="list-group-item">Nom de famille : <?php echo $m['lastname']; ?></li>
                      <li class="list-group-item">Prénom : <?php echo $m['firstname']; ?></li>
                      <li class="list-group-item">Adresse : <?php echo $m['userAddress']; ?></li>
                      <li class="list-group-item">Code Postal : <?php echo $m['postalCode']; ?></li>
                      <li class="list-group-item">Ville : <?php echo $m['city']; ?></li>
                      <li class="list-group-item">Code Postal : <?php echo $m['postalCode']; ?></li>
                      <li class="list-group-item">Tél : +33<?php echo $m['phoneNumber']; ?></li>
                    </ul>
                    <a class="btn btn-danger" id="ban" role="button" data-toggle="modal" data-target="#banBox<?php echo $m['userId'] ?>" href="viewUsers.php?bannir=<?php echo $m['userId']; ?>">
                    <i class="fa fa-plus-circle"></i>Bannir</a>
                    <a class="btn btn-primary" id="modifier" role="button" href="modifuser.php?modifier=<?php echo $m['userId']; ?>">modifier</a>
                  </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="banBox<?php echo $m['userId'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Bannir un utilisateur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="../libs/php/ban.php" method="post">
                          <div class="form-group">
                            <label for="banNameInput">Bannir temporairement : <?php echo $m['pseudo']; ?></label>
                            <input type="date" class="form-control" name="bandate" id="banDateInput">
                          </div>
                          <div class="form-group">
                            <label for="banDateInput">Bannir définitivement</label>
                            <input type="checkbox" name="banDefinitif">
                          </div>

                          <input type="hidden" name="userId" value="<?php echo $m['userId']; ?>">

                          <button type="submit" name="banFormSubmit" class="btn btn-success">Bannir</button>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- fin du while -->
            <?php } ?>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
