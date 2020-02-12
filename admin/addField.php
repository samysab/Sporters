<?php
  include('functions/functions.php');
  include('../libs/php/db/db_connect.php');
  hasAccess();


  if (isset($_POST['formAddField'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $codePostal = htmlspecialchars($_POST['codePostal']);
    $sports = htmlspecialchars($_POST['sports']);

    if (empty($_POST['nom']) || empty($_POST['adresse']) || empty($_POST['codePostal']) || empty($_POST['sports'])) {
      header('location:addField.php?errors=field_blank');
      exit;
    }
    $nomlength = strlen($nom);
    if ($nomlength > 45) {
      header('location:addField.php?errors=name_to_long');
      exit;
    }
    $adresselength = strlen($adresse);
    if ($adresselength > 45) {
      header('location:addField.php?errors=address_to_long');
      exit;
    }
    $postalCodelength = strlen($codePostal);
    if ($postalCodelength > 5) {
      header('location :addField.php?errors=postalCode_wrong');
    }
    $pattern = "#[^0-9]#";
    if (preg_match($pattern, $codePostal)) {
      header('Location: addField.php?errors=postalCode_wrong');
      exit;
    }

    include('../libs/php/db/db_connect.php');

    $q = 'INSERT INTO fields(fieldAddress, fieldName, fieldPostalCode, fieldSport) VALUES (:fieldAddress, :fieldName, :fieldPostalCode, :fieldSport)';
    $req = $conn->prepare($q);

    $req -> execute(array(
      'fieldAddress' => htmlspecialchars($_POST['adresse']),
      'fieldName' => htmlspecialchars($_POST['nom']),
      'fieldPostalCode' => htmlspecialchars($_POST['codePostal']),
      'fieldSport' => htmlspecialchars($_POST['sports'])
    ));

    header('location:addField.php?submit=addfield');
  }
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Ajouter un terrain</title>
</head>
  <body>
    <?php include('../libs/php/headers/admDashHeader.php'); ?>
    <main>
      <div class="container-fluid">
        <div class="container bg-light filledContainer">
          <form name="addField_form" method="post" action="">
            <div class="form-row">
              <div class="form-group col-md-6">
                <img class="icon" src="../ressources/images/sporters_form_icon.png" alt="sporters_form_icon">
              </div>
              <div class="form-group col-md-6">
                <?php if(isset($_GET['errors']) AND $_GET['errors']=='field_blank'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Tout les champs doivent être remplis !'. '</div>';
                }
                if(isset($_GET['errors']) AND $_GET['errors']=='name_to_long'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le nom du terrain ne peut pas dépasser 45 caracteres !'. '</div>';
                }
                if(isset($_GET['submit']) AND $_GET['submit']=='addfield'){
                  echo '<div class="alert alert-success col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Vous avez ajouté un terrain'. '</div>';
                }

                if(isset($_GET['errors']) AND $_GET['errors']=='postalCode_wrong'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Le code postal doit etre de 5 chiffres  !'. '</div>';
                }
                if(isset($_GET['errors']) AND $_GET['errors']=='address_to_long'){
                  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'L\'adresse du terrain ne peut pas dépasser 45 caracteres !'. '</div>';
                }
                ?>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Nom</label>
                <input  type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Saisir le nom du complexe/ stade" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>">
              </div>
              <div class="form-group col-md-6">
                <label>adresse</label>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Saisir l'adresse du complexe" aria-label="Input group example" aria-describedby="btnGroupAddon" id="adresse" name="adresse" value="<?php if(isset($adresse)) { echo $adresse; } ?>">
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Code postal</label>
                <input type="text" class="form-control" id="codePostal" name="codePostal" placeholder="Saisir le code postal">
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
            <button type="submit" name="formAddField" class="btn btn-primary">Envoyer</button>
          </form>
        </div>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
