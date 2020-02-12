<!-- Bouton suppression règle -->
<button type="button" class="close" aria-label="Close" data-toggle="modal" data-target="#exampleModalCenter<?php echo $result["gameId"]; ?>">
  <span aria-hidden="true">&times;</span>
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter<?php echo $result["gameId"]; ?>" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Supprimer la partie <?php echo $result["gameName"]; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Voulez vous vraiment supprimer cette partie ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <a href="dashgames.php?delgame=<?php echo $result["gameId"]; ?>" type="button" class="btn btn-success link-btn">Confirmer</a>
      </div>
    </div>
  </div>
</div>
