<?php if (isset($_GET["account"]) && $_GET["account"] == "checked") { ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Compte validé !</strong> Vous avez bien mis à jour votre compte
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "empty_fields") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez remplir tous les champs !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "address_missing") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir une adresse !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "address_length") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir une adresse avec maximum 50 caractères !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "cp_missing") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir un code postal !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "invalid_cp_format") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir un code postal valide !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "city_missing") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir une ville !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "phone_missing") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir un numéro de téléphone !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "phone_format") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir un numéro de téléphone valide !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "phone_length") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir un numéro de téléphone valide !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "file_type") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez ajouter une photo de profil au bon format !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "file_exists") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Cette photo est déjà utilisée !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "file_format") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Les extensions acceptées sont jpeg,jpg,png et gif !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "image_size") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> La photo ne doit pas dépasser 200Kb !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "photo_missing") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez ajouter une photo de profil !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
