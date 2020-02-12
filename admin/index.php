<?php
  include('functions/functions.php');
  hasAccess();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>Sporters | Panel</title>
  <body>
    <?php include ('../libs/php/headers/admDashHeader.php'); ?>
    <main>
      <div class="container-fluid filledSection">
        <div class="container bg-light filledContainer">
          <?php // if (isset($_GET['submit']) AND $_GET['submit'] == 'addfield') { ?>
            <!-- <div class="alert alert-success" role="alert"> -->
              <!-- Le terrain a bien été ajouter a votre base de donnée ! -->
            <!-- </div> -->
          <?php // } ?>
          <?php if (isset($_GET['errors']) AND $_GET['errors'] == 'unauthorized_access') { ?>
            <div class="alert alert-danger" role="alert">
              Tu n'a pas les droits pour aller sur cette page !
            </div>
          <?php } ?>

          <h1>Activités récentes</h1>

<!--           <table class="table">
            <thead>
              <tr>
                <td>Membres</td>
                <td>Groupes</td>
                <td>Parties</td>
                <td>Achats</td>
              </tr>
            </thead>
 -->
            <?php

            // fonction pour récupérer les dernieres lignes
            include('../libs/php/db/db_connect.php');
            function getLastLines($bdd, $table, $ahref, $index) {
              $query = $bdd->prepare('SELECT * FROM '.$table.' ORDER BY 1 DESC LIMIT 3');
              $query->execute();
              $rows = $query->rowCount();
              for ($i = 0; $i < $rows; $i++) {
                  while ($user = $query->fetch()) {
                    if ($table == "products") {
                      echo '<a href="' . $ahref . $user[$index] . '">' . $user[$index] . '</a>';
                    } else {
                      echo '<a href="' . $ahref . '.php?modifier=' . $user[0] . '">' . $user[$index] . '</a>';
                    }
                    echo '<br>';
                  }
              }


            }

            echo '<h4>Membres inscrits</h4>';
            getLastLines($conn, "users", "modifuser", 2);

            echo '<hr>';

            echo '<h4>Produits ajoutés</h4>';
            getLastLines($conn, "products", "viewProducts.php?modifier=", 1);

            echo '<hr>';

            echo '<h4>Parties créées</h4>';
            getLastLines($conn, "games", "viewGames", 1);


            ?>

          <!-- </table> -->


        </div>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
