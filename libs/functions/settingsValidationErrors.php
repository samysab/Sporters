<?php if (isset($_GET["submit"]) && $_GET["submit"] == "check") { ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Compte validé !</strong> Vous avez bien mis à jour votre compte !
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
<?php if (isset($_GET["error"]) && $_GET["error"] == "address_length") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir une adresse avec maximum 50 caractères !
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
<?php if (isset($_GET["error"]) && $_GET["error"] == "invalid_cp_length") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir un code postal français valide !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "city_format") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir une ville !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "invalid_city_length") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir une ville avec maximum 50 caractères !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "invalid_phone_format") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir un numéro de téléphone valide !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "invalid_phone_length") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Le numéro de téléphone n'est pas valide !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "file_format") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez saisir une photo au format jpeg, jpg, png ou gif !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "image_size") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> La taille maximale de la photo est de 200KB !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "file_exists") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> La photo existe déjà !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] == "empty_photo") { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attention !</strong> Vous devez ajouter une photo pour la changer !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
