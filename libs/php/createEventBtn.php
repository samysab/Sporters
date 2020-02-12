<!-- Create Event -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#createEvent"><i class="fa fa-plus-circle"></i> Créer</button>
<!-- Modal -->
<div class="modal fade" id="createEvent" tabindex="-1" role="dialog" aria-labelledby="createEventTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createEventTitle">Créer un évènement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="libs/php/createEvent.php" method="post">
          <div class="form-group">
            <label for="eventNameInput">Nom de l'évènement</label>
            <input type="text" class="form-control" name="eventname" id="eventNameInput" placeholder="Saisir un nom pour l'event'">
          </div>
          <div class="form-group">
            <label for="eventDateInput">Date</label>
            <input type="date" class="form-control" name="eventdate" id="eventDateInput">
          </div>
          <div class="form-group">
            <label for="eventSportInput">Sport</label>
            <select class="form-control" name="eventsport" id="eventSportInput">
              <option value="foot">Football</option>
              <option value="basket">Basketball</option>
              <option value="tennis">Tennis</option>
              <option value="rugby">Rugby</option>
              <option value="running">Running</option>
            </select>
          </div>
          <div class="form-group">
            <label for="eventFieldInput">Terrain</label>
            <select class="form-control" name="eventfield" id="eventFieldInput">
              <?php
                $sql = "SELECT * FROM fields";
                $request = $conn->prepare($sql);
                $request->execute();
                while ($response = $request->fetch()) {
                  echo '<option value="' . $response["fieldAddress"] . '">' . $response["fieldAddress"] . ' - ' . $response["fieldPostalCode"] . '</option>';
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="eventSlotsInput">Nombre de places</label>
            <input type="number" min="2" max="100" class="form-control" name="eventslots" id="eventSlotsInput">
          </div>
          <div class="form-group">
            <label for="eventPriceInput">Prix d'entrée par joueur</label>
            <div class="input-group mb-3">
              <input type="text" id="eventPriceInput" class="form-control" name="eventprice" aria-label="Amount (to the nearest dollar)">
              <div class="input-group-append">
                <span class="input-group-text">.00 €</span>
              </div>
            </div>
          </div>
          <button type="submit" name="eventFormSubmit" class="btn btn-success">Créer</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>
