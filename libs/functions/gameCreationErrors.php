<?php if (isset($_GET["error"]) && $_GET["error"] == "empty_fields") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous remplir tous les champs !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "empty_gamename") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir un nom pour la partie !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "gamename_length") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez ajouter un nom qui ne doit pas dépasser 30 caractères !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "empty_gamedate") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir une date pour la partie !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "gamedate_invalid") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir une date correcte !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "empty_gamesport") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir un sport pour la partie !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "empty_gamefield") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir un terrain pour la partie !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "empty_gameslots") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez préciser le nombre de places pour la partie !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["game"]) && $_GET["game"] == "success") { ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Félicitations !</strong> Votre partie est enregistrée !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
