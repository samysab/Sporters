<?php
include('libs/functions/functions.php');
include('libs/php/db/db_connect.php');

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Sporters | CGU</title>
  </head>
  <body>
    <?php include ('libs/php/headers/mainHeader.php'); ?>
    <main>
      <div class="container-fluid filledSection">
        <div class="container filledContainer bg-light">
          <h1 class="title">Conditions Générales d'Utilisation</h1>
          <?php
          // Récupération des CGU depuis la BDD
          $q = "SELECT * FROM cgu";
          $req = $conn->prepare($q);
          $req->execute();
          ?>
          <div class="accordion" id="accordionExample">
            <?php while($res = $req->fetch()){ ?>
            <div class="card">
              <div class="card-header" id="card<?php echo $res["cgu_id"]; ?>">
                <h2 class="mb-0">
                  <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapse<?php echo $res["cgu_id"]; ?>" aria-expanded="true" aria-controls="collapse<?php echo $res["cgu_id"]; ?>">
                    <?php echo $res["cgu_id"]; ?>
                  </button>
                </h2>
              </div>
              <div id="collapse<?php echo $res["cgu_id"]; ?>" class="collapse" aria-labelledby="heading<?php echo $res["cgu_id"]; ?>" data-parent="#accordionExample">
                <div class="card-body">
                  <?php echo $res["article"]; ?>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
