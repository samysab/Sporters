<?php
  include('functions/functions.php');
  include('../libs/php/db/db_connect.php');
  hasAccess();
  if ($_SESSION['admin']['adminPrivilege'] != 2) {
    header('location:index.php?errors=unauthorized_access');
    exit;
  }

  if (isset($_POST['formaddAdmin'])) {
    $nom = htmlspecialchars($_POST['pseudo']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $mdp2 = htmlspecialchars($_POST['mdp2']);

    if (empty($_POST['pseudo']) || empty($_POST['mdp']) || empty($_POST['mdp2'])) {
      header('location:addAdmin.php?errors=field_blank');
      exit;
    }
    $pseudolength = strlen($pseudo);
    if ($pseudolength > 45) {
      header('location:addAdmin.php?errors=pseudo_to_long');
      exit;
    }
    if ($mdp != $mdp2) {
      header('location:addAdmin.php?errors=wrong_password');
      exit;
    }

    include('../libs/php/db/db_connect.php');

    $q = 'INSERT INTO admin(adminPseudo, adminPassword, adminPrivilege) VALUES (:adminPseudo, :adminPassword, 0)';
    $req = $conn->prepare($q);

    $req -> execute(array(
      'adminPseudo' => htmlspecialchars($_POST['pseudo']),
      'adminPassword' => hash('sha256', $mdp)
    ));

    header('location:addAdmin.php?submit=addAdmin');
  }
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Ajouter un administrateur</title>
</head>
  <body>
    <?php include('../libs/php/headers/admDashHeader.php'); ?>
    <main>
      <div class="container-fluid">
        <div class="container bg-light filledContainer">
          <h1 class="title">Ajouter un Admin</h1>
          <form name="addAdmin_form" method="post" action="">
            <div class="form-row">
              <div class="form-group col-md-6">
                <img class="icon" src="../ressources/images/sporters_form_icon.png" alt="sporters_form_icon">
              </div>
              <div class="form-group col-md-6">
                <?php if(isset($_GET['errors']) AND $_GET['errors']=='field_blank'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Tout les champs doivent être remplis !'. '</div>';
                }
                if(isset($_GET['errors']) AND $_GET['errors']=='pseudo_to_long'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le pseudo ne peut pas dépasser 45 caracteres !'. '</div>';
                }
                if(isset($_GET['submit']) AND $_GET['submit']=='addAdmin'){
                  echo '<div class="alert alert-success col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le nouvel administateur a bien été ajouté !'. '</div>';
                }
                /*
                if(isset($_GET['errors']) AND $_GET['errors']=='postalCode_wrong'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le code postal doit etre de 5 chiffres  !'. '</div>';
                }*/
                if(isset($_GET['errors']) AND $_GET['errors']=='wrong_password'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'les mots de passe ne correspondent pas !'. '</div>';
                }
                ?>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Pseudo</label>
                <input  type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Saisir le pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>">
              </div>
              <div class="form-group col-md-6">
                <label>Mot de passe</label>
                <div class="input-group">
                  <input type="password" class="form-control" placeholder="Saisir le mot de passe" aria-label="Input group example" aria-describedby="btnGroupAddon" id="mdp" name="mdp" value="<?php if(isset($mdp)) { echo $mdp; } ?>">
                </div>
              </div>
              <div class="form-group col-md-6">
                <label>Confirmation</label>
                <div class="input-group">
                  <input type="password" class="form-control" placeholder="Confirmation du mot de passe" aria-label="Input group example" aria-describedby="btnGroupAddon" id="mdp2" name="mdp2" value="<?php if(isset($mdp2)) { echo $mdp2; } ?>">
                </div>
              </div>
            </div>
            <button type="submit" name="formaddAdmin" class="btn btn-primary">Envoyer</button>
          </form>
        </div>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
