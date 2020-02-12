<form action="profil_photo_check.php" method="post" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="pic">Photo</label>
      <input type="file" name="profilepic" id="pic" class="form-control-file">
      <small class="text-muted">La taille maximale est de 200KB.</small>
    </div>
    <div class="form-group col-md-6">
      <img src="<?php echo $result['userProfilePic']; ?>" alt="photo_profil"
      style="height:100px;width:100px;border:2px solid black;border-radius:50px">
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6">
      <button type="submit" name="settings_submit" class="btn btn-success">Changer</button>
    </div>
  </div>
</form>
<hr>
<form action="libs/php/settings_check.php" method="post" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputlname">Nom</label>
      <input type="text" name="lname" class="form-control" id="inputlname" value="<?php echo $result['lastname']; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputfname">Prénom</label>
      <input type="text" name="fname" class="form-control" id="inputfname" value="<?php echo $result["firstname"]; ?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="exampleInputEmail1">Adresse Email</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
      placeholder="Saisir l'email" name="email" value="<?php echo $result["email"]; ?>" readonly>
    </div>
    <div class="form-group">
      <label>Pseudo</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text" id="btnGroupAddon">@</div>
        </div>
        <input type="text" class="form-control" placeholder="Saisir un pseudo" aria-label="Input group example"
        aria-describedby="btnGroupAddon" id="pseudo" name="pseudo" value="<?php echo $result["pseudo"]; ?>">
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputaddr">Adresse</label>
      <input type="text" name="address" class="form-control" id="inputaddr" value="<?php echo $result["userAddress"]; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="">Code Postal</label>
      <input type="text" name="cp" class="form-control" placeholder="Saisir le code postal"
      value="<?php echo $result["postalCode"]; ?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="ville">Ville</label>
      <input type="text" class="form-control" name="city" id="ville" placeholder="Saisir le nom d'une ville"
      value="<?php echo $result["city"]; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="tel">Téléphone</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text" id="btnGroupAddon">+33</div>
        </div>
        <input type="text" class="form-control" name="phone" id="tel" placeholder="Saisir le numéro de téléphone"
        value="<?php echo $result["phoneNumber"]; ?>">
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6">
      <button type="submit" name="settings_submit" class="btn btn-success">Mettre à jour</button>
    </div>
  </div>
</form>
