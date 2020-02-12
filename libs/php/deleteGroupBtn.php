<!-- Bouton suppression règle -->
<button type="button" class="close" aria-label="Close" data-toggle="modal" data-target="#exampleModalCenter<?php echo $result["groupId"]; ?>">
  <span aria-hidden="true">&times;</span>
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter<?php echo $result["groupId"]; ?>" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Supprimer la partie <?php echo $result["groupName"]; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Voulez vous vraiment supprimer cette partie ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <a href="dashgroups.php?delgroup=<?php echo $result["groupId"]; ?>" type="button" class="btn btn-success link-btn">Confirmer</a>
      </div>
    </div>
  </div>
</div>
