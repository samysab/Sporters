<?php if (isset($_GET["error"]) && $_GET["error"] == "empty_fields") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous remplir tous les champs !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "empty_eventname") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir un nom pour l'évènement !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "eventname_length") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez ajouter un nom qui ne doit pas dépasser 30 caractères !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "empty_eventdate") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir une date pour l'évènement' !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "eventdate_invalid") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir une date correcte !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "empty_eventsport") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir un sport pour la partie !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "empty_eventfield") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir un terrain pour la partie !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "empty_eventslots") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez préciser le nombre de places pour la partie !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["event"]) && $_GET["event"] == "success") { ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Félicitations !</strong> Votre évènement est enregistré !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
