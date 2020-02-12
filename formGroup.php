<?php
include('libs/functions/functions.php');
if (!isConnected()) {
  header('Location: login.php');
}
?>
<?php

  if (isset($_POST['formCreateGroup'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $sport = $_POST['sports'];

    if (empty($nom) || empty($sport)) {
      header('location:formGroup.php?errors=field_blank');
      exit;
    }
    $nomlength = strlen($nom);
    if ($nomlength > 45) {
      header('location:formGroup.php?errors=name_to_long');
      exit;
    }
    include('libs/php/db/db_connect.php');

    $q = "SELECT groupId FROM groups WHERE groupName = ?";
    $req= $conn->prepare($q);
    $req-> execute(array($_POST['nom']));

    $answers = [];
    while ($groupName = $req->fetch()) {
      $answers[] = $groupName;
    }
    if (count($answers) != 0) { //nom deja pris
      header('location: formGroup.php?errors=groupName_taken');
      exit;
    }

    $q = 'INSERT INTO groups(groupName, groupSport, users_userId, users_email, groupOwner) VALUES (:groupName	, :groupSport, :users_userId, :users_email, :groupOwner)';
    $req = $conn->prepare($q);

    $req -> execute(array(
      'groupName' => htmlspecialchars($_POST['nom']),
      'groupSport' => $_POST['sports'],
      'users_userId' => $_SESSION['user']['userId'],
      'users_email' => $_SESSION['user']['email'],
      'groupOwner' => $_SESSION['user']['pseudo']
    ));
    header('location:dashgroups.php?submit=createGroup');
  }

 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>créer une partie</title>
  </head>
  <body>
    <?php include ('libs/php/headers/mainHeader.php'); ?>
    <main>
      <br>
      <div class="container-fluid">
        <div class="container bg-light filledContainer">
          <form name="createGroup_form" method="post" >
            <div class="form-row">
              <div class="form-group col-md-6">
                <img class="icon" src="/sporters/ressources/images/sporters_form_icon.png" alt="sporters_form_icon">
              </div>
              <div class="form-group col-md-6">
                <?php if(isset($_GET['errors']) AND $_GET['errors']=='field_blank'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Tout les champs doivent être remplis !'. '</div>';
                }
                if(isset($_GET['errors']) AND $_GET['errors']=='name_to_long'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le nom du groupe ne peut pas dépasser 45 caracteres !'. '</div>';
                }
                if(isset($_GET['errors']) AND $_GET['errors']=='groupName_taken'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le nom du groupe existe déja. Merci de le changer le nom !'. '</div>';
                }
                ?>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Nom du groupe</label>
                <input  type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Saisir le nom du groupe" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>">
              </div>
              <div class="form-group col-md-6">
                  <label for="exampleInputPassword1">sport</label>
                  <select class="" name="sports">
                    <option value="">--selectionner le sport--</option>
                    <option value="football">football</option>
                    <option value="basketball">basketball</option>
                    <option value="tennis">tennis</option>
                    <option value="boxe">boxe</option>
                    <option value="omnisport">omnisport</option>
                  </select>
                  <small class="form-text text-muted">Selectionner 'omnisport' si le complexe comporte plusieurs sport.</small>
                </div>
              </div>
            <button type="submit" name="formCreateGroup" class="btn btn-primary">Envoyer</button>
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
