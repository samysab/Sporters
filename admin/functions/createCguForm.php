<form name="faqform" action="functions/addCGU.php" method="post">
  <h1 class="title">Ajouter une CGU</h1>
  <div class="form-group">
    <div class="form-row">
      <div class="col-md-6">
        <?php if (isset($_GET["submit"]) && $_GET["submit"] == "success") { ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Bravo !</strong> Vous avez ajouté une nouvelle CGU à la base de données.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php } ?>
        <?php if (isset($_GET["error"]) && $_GET["error"] == "rule_missing") { ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Mince!</strong> Vous avez oublié de saisir une règle.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="cguInput">Règle</label>
    <input type="text" class="form-control" name="cgu" placeholder="Saisir une règle" id="cguInput">
  </div>
  <button type="submit" class="btn btn-success">Ajouter</button>
  <!-- Vider la table des cgu -->
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
    Supprimer
  </button>

  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Supprimer toutes les CGU</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Voulez-vous vraiment supprimer toutes les CGU ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
          <a type="button" class="btn btn-success link-btn" href="../libs/php/deleteCGU.php">Confirmer</a>
        </div>
      </div>
    </div>
  </div>
</form>
