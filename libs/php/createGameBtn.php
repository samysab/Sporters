<!-- Create Game -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#createGame"><i class="fa fa-plus-circle"></i> Créer</button>
<!-- Modal -->
<div class="modal fade" id="createGame" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Créer une partie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="libs/php/createGame.php" method="post">
          <div class="form-group">
            <label for="gameNameInput">Nom de la partie</label>
            <input type="text" class="form-control" name="gamename" id="gameNameInput" placeholder="Saisir un nom pour la partie">
          </div>
          <div class="form-group">
            <label for="gameDateInput">Date</label>
            <input type="date" class="form-control" name="gamedate" id="gameDateInput">
          </div>
          <div class="form-group">
            <label for="gameSportInput">Sport</label>
            <select class="form-control" name="gamesport" id="gameSportInput">
              <option value="Football">Football</option>
              <option value="Basketball">Basketball</option>
              <option value="Tennis">Tennis</option>
              <option value="Rugby">Rugby</option>
              <option value="Running">Running</option>
            </select>
          </div>
          <div class="form-group">
            <label for="gameFieldInput">Terrain</label>
            <select class="form-control" name="gamefield" id="gameFieldInput">
              <?php
                $sql = "SELECT * FROM fields";
                $req = $conn->prepare($sql);
                $req->execute();
                while ($res = $req->fetch()) {
                  echo '<option value="' . $res["fieldAddress"] . '">' . $res["fieldAddress"] . ' - ' . $res["fieldPostalCode"] . '</option>';
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="gameSlotsInput">Nombre de places</label>
            <input type="number" min="2" max="30" class="form-control" name="gameslots" id="gameSlotsInput">
          </div>
          <button type="submit" name="gameFormSubmit" class="btn btn-success">Créer</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>
