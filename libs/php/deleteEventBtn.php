<!-- Bouton suppression évènement -->
<button type="button" class="close" aria-label="Close" data-toggle="modal" data-target="#exampleModalCenter<?php echo $result["enventId"]; ?>">
  <span aria-hidden="true">&times;</span>
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter<?php echo $result["enventId"]; ?>" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Supprimer l'évènement : <?php echo $result["eventName"]; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Voulez vous vraiment supprimer cet évènement ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <a href="dashevents.php?delevent=<?php echo $result["enventId"]; ?>" type="button" class="btn btn-success link-btn">Confirmer</a>
      </div>
    </div>
  </div>
</div>
