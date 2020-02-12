<?php
  include('../libs/php/db/db_connect.php');
  include('functions/functions.php');
  hasAccess();

  if(isset($_GET['supprimer']) AND !empty($_GET['supprimer'])) {
      $supprimer = (int) $_GET['supprimer'];
      $req = $conn->prepare('DELETE FROM games WHERE gameId = ?');
      $req->execute(array($supprimer));
   }
   if(isset($_GET['modifier']) AND !empty($_GET['modifier'])) {
     $modifier = (int) $_GET['modifier'];
     $req = $conn->prepare('SELECT * FROM games WHERE gameId = ?');
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
    <div class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="jumbotron col-12">
            <h1>Les évènements :</h1>
              <?php
                $show = $conn->query('SELECT * FROM events');
                echo '<div class="row">';
                while ($m = $show->fetch()){
                  $date = date_create($m['eventDate']);

                  echo '<div  class="col-md-4">';
                  echo '<p id="fiche">' . 'Id : ' . $m['eventId']. '</br>' . 'Nom de l\'évènement : ' . $m['eventName'] . '</br>' .'Aura lieu le : ' . date_format($date,'d/m/Y') .'<br>';
                  echo 'Sport : ' . $m['eventSport'] . '</br>' . $m['eventSlot'] . ' Joueurs peuvent rejoindre';
                  ?>
                  <br>
                  <a class="btn btn-primary" id="ban" role="button" href="viewGroups.php?supprimer=<?= $m['eventId'] ?>">Supprimer</a>
                  <a class="btn btn-primary" id="modifier" role="button" href="modifEvents.php?modifier=<?= $m['eventId'] ?>">modifier</a>
                  <?php
                  echo '</p>' . '</div>';
                }
                echo '</div>';
              ?>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
