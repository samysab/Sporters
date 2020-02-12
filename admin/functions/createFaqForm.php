<!-- Ajouter ou supprimers les FAQ -->
<form name="faqform" action="functions/addFAQ.php" method="post">
  <h1 class="title">Ajouter une Question/Réponse</h1>
  <div class="form-group">
    <?php if (isset($_GET["submit"]) && $_GET["submit"] == "success") { ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Bravo !</strong> Vous avez ajouté une nouvelle faq à la base de données.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
    <?php if (isset($_GET["error"]) && $_GET["error"] == "question_missing") { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Mince!</strong> Vous avez oublié de saisir une question !
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
    <?php if (isset($_GET["error"]) && $_GET["error"] == "answer_missing") { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Mince!</strong> Vous avez oublié de saisir une réponse !
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
  </div>
  <div class="form-group">
    <label for="questionInput">Question</label>
    <input type="text" class="form-control" name="question" placeholder="Saisir une question" id="questionInput">
  </div>
  <div class="form-group">
    <label for="answerInput">Réponse</label>
    <input type="text" class="form-control" name="answer" placeholder="Saisir une réponse" id="answerInput">
  </div>
  <button type="submit" class="btn btn-success">Ajouter</button>
  <!-- Vider la table des faq -->
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
    Supprimer
  </button>

  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Supprimer toutes les FAQ</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Voulez-vous vraiment supprimer toutes les FAQ ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
          <a type="button" class="btn btn-success link-btn" href="../libs/php/deleteFAQ.php">Confirmer</a>
        </div>
      </div>
    </div>
  </div>
</form>
