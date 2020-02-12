<?php
  include('functions/functions.php');
  include('../libs/php/db/db_connect.php');
  hasAccess();

  if (isset($_GET["delfaq"]) && !empty($_GET["delfaq"])) {
    $delfaq = (int) $_GET["delfaq"];
    $sql = $conn->prepare('DELETE FROM faq WHERE faqId = ?');
    $sql->execute(array($delfaq));
  }
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Sporters | Dashboard</title>
  <body>
    <?php include('../libs/php/headers/admDashHeader.php'); ?>
    <main>
      <div class="container-fluid filledSection">
        <div class="container bg-light filledContainer">

          <?php include('functions/createFaqForm.php'); ?>
          <hr>

          <!-- Afficher et supprimer des CGU -->
          <h1 class="title">Foire aux questions</h1>
          <?php
          // Récupération des faq depuis la BDD
          $q = "SELECT * FROM faq";
          $req = $conn->query($q);
          ?>
          <div class="accordion" id="accordionExample">
            <?php while($list = $req->fetch()){ ?>
            <div class="card">
              <div class="card-header" id="card<?php echo $list["faqId"]; ?>">
                <h2 class="mb-0">
                  <button class="btn btn-success" type="button" data-toggle="collapse"
                  data-target="#collapse<?php echo $list["faqId"]; ?>" aria-expanded="true" aria-controls="collapse<?php echo $list["faqId"]; ?>">
                    <?php echo $list["faqId"]; ?>
                  </button>
                </h2>
              </div>
              <div id="collapse<?php echo $list["faqId"]; ?>" class="collapse"
                aria-labelledby="heading<?php echo $list["faqId"]; ?>" data-parent="#accordionExample">
                <div class="card-body">
                  <?php echo $list["questions"]; ?>
                  <hr>
                  <?php echo $list["answers"]; ?>
                  <!-- Bouton suppression règle -->
                  <button type="button" class="close" aria-label="Close" data-toggle="modal"
                  data-target="#exampleModalCenter<?php echo $list["faqId"]; ?>">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModalCenter<?php echo $list["faqId"]; ?>"
                    tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalCenterTitle">Supprimer la règle <?php echo $list["faqId"]; ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Voulez vous vraiment supprimer cette règle dans les faq ?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                          <a href="faq_manager.php?delfaq=<?php echo $list["faqId"]; ?>" type="button" class="btn btn-success link-btn">Confirmer</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>

        </div>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
