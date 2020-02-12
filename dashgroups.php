<?php
include('libs/functions/functions.php');
include('libs/php/db/db_connect.php');
include('libs/functions/isVerified.php');
include('libs/functions/selectUserInfos.php');


if (!isConnected()) {
  header('Location: login.php');
}

isVerified($_SESSION["user"]["userId"]);

if (isset($_GET["delgroup"]) && !empty($_GET["delgroup"])) {
  $delgroup = (int) $_GET["delgroup"];
  $deletegame = $conn->prepare('DELETE FROM groups_history WHERE groups_groupId = ?');
  $deletegame->execute(array($delgroup));
  $deletegame = $conn->prepare('DELETE FROM groups WHERE groupId = ?');
  $deletegame->execute(array($delgroup));
}

if (isset($_GET["leavegroup"]) && !empty($_GET["leavegroup"])) {
  $delgroup = (int) $_GET["leavegroup"];
  $deletegame = $conn->prepare('DELETE FROM groups_history WHERE groups_groupId = ?');
  $deletegame->execute(array($delgroup));
}

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Sporters | Dashboard</title>
  </head>
  <body>
    <?php include('libs/php/headers/mainHeader.php'); ?>
    <div class="container-fluid">
      <div class="row">
        <?php include('libs/php/headers/dashHeader.php'); ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="container-fluid filledSection">
            <div class="container bg-light filledContainer">
              <div class="jumbotron col-12">
                <?php if (isset($_GET['submit']) AND $_GET['submit'] == 'createGroup') { ?>
                  <div class="alert alert-success" role="alert">
                    Le groupe a bien été créer !
                  </div>
                <?php } ?>
                <div class="col-md-8">
                  <h2>Groupes :</h2>
                  <a href="formGroup.php" class="btn btn-info" role="button">Créer un groupe </a>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#joinGroups"><i class="fa fa-search-plus"></i> Rejoindre</button>

                  <?php include_once('libs/php/joinGroup.php'); ?>
                </div>
                <?php //voir le groupe si c'est lui meme le createur
                $q = "SELECT * FROM groups WHERE users_userId = ?";
                $request = $conn->prepare($q);
                $request->execute([$_SESSION["user"]["userId"]]);
                while($result = $request->fetch()){
                  echo '<div class="accordion" id="accordionExample">';
                  //Voir les joueurs d'un groupe
                  $q = "SELECT users_userId FROM groups_history WHERE groups_history.groups_groupId = ? ";
                  $requests = $conn->prepare($q);
                  $requests->execute([$result['groupId']]);
                ?>
                <div class="card">
                  <div class="card-header" id="card<?php echo $result["groupId"]; ?>">
                    <h2 class="mb-0">
                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse<?php echo $result["groupId"]; ?>"
                        aria-expanded="true" aria-controls="collapse<?php echo $result["groupId"]; ?>">
                        <?php echo $result["groupName"]; ?>
                      </button>
                    </h2>
                  </div>
                  <div id="collapse<?php echo $result["groupId"]; ?>" class="collapse" aria-labelledby="heading<?php echo $result["groupId"]; ?>"
                    data-parent="#accordionExample">
                    <div class="card-body">
                      <?php include("libs/php/deleteGroupBtn.php"); ?>
                      <form>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="sportInput">Sport</label>
                            <input type="text" id="sportInput" class="form-control" name="gameSport"
                            value="<?php echo $result["groupSport"]; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="slotsInput">créateur du groupe</label>
                            <input type="text" id="slotsInput" class="form-control" name="groupOwner"
                            value="<?php echo $result["groupOwner"]; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">

                        <p>  Liste des joueurs :</p><br>

                          <?php

                          while($perso = $requests->fetch()){
                            $requPseudo = 'SELECT pseudo,userId  FROM users WHERE userId = ?';
                            $selectPseudo = $conn->prepare($requPseudo);
                            $selectPseudo->execute(array($perso['users_userId']));
                            while ($userId = $selectPseudo->fetch()) {



                            $group_id = $result['groupId'];
                            echo '<a  name="kickplayer" href="dashgroups.php?" data-toggle="modal" id="pseudokick" data-pseudo="'.$userId['pseudo'].'" data-target="#exampleModal" >'. $userId['pseudo'].'</a><br>';
                          ?>

                          <div name="modalKick" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content" >
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Expulser un joueur ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    Etes-vous sûr de vouloir kick ?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                                    <button type="submit" name="kickplayer" onclick="supprimer(<?php echo $userId['userId'].',' .$group_id; ?>)" class="btn btn-primary">OUI</button>
                                  </div>
                                </div>
                              </div>
                            <?php } ?>
                              </div>
                            <?php } ?>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <?php } ?>
                <?php
                //voir si l'user a rejoint un groupe et l'afficher
                $q = "SELECT * FROM groups_history WHERE users_userId = ?";
                $request = $conn->prepare($q);
                $request->execute([$_SESSION["user"]["userId"]]);

                while($result = $request->fetch()){
                  echo '<div class="accordion" id="accordionExample">';
                  $reds = 'SELECT * FROM groups WHERE groupId = ?';
                  $reqq = $conn->prepare($reds);
                  $reqq->execute(array(
                    $result['groups_groupId']
                  ));
                  while ($group = $reqq->fetch()) {


                  //voir les joueurs d'un meme groupe
                  $q = "SELECT users_userId FROM groups_history WHERE groups_history.groups_groupId = ? ";
                  $requests = $conn->prepare($q);
                  $requests->execute([$result['groups_groupId']]);

                  if ($group['groupOwner'] != $_SESSION['user']['pseudo']) {

                ?>
                <div class="card">
                  <div class="card-header" id="card<?php echo $group["groupId"]; ?>">
                    <h2 class="mb-0">
                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse<?php echo $group["groupId"]; ?>"
                        aria-expanded="true" aria-controls="collapse<?php echo $group["groupId"]; ?>">
                        <?php echo $group["groupName"]; ?>
                      </button>
                    </h2>
                  </div>
                  <div id="collapse<?php echo $group["groupId"]; ?>" class="collapse" aria-labelledby="heading<?php echo $group["groupId"]; ?>"
                    data-parent="#accordionExample">
                    <div class="card-body">
                      <?php include("libs/php/leaveGroupBtnBis.php"); ?>
                      <form>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="sportInput">Sport</label>
                            <input type="text" id="sportInput" class="form-control" name="gameSport"
                            value="<?php echo $group["groupSport"]; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="slotsInput">créateur du groupe</label>
                            <input type="text" id="slotsInput" class="form-control" name="gameSlot"
                            value="<?php echo $group["groupOwner"]; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">

                          Liste des joueurs : <br>
                          <?php

                          while($perso = $requests->fetch()){
                            $requPseudo = 'SELECT pseudo FROM users WHERE userId = ?';
                            $selectPseudo = $conn->prepare($requPseudo);
                            $selectPseudo->execute(array($perso['users_userId']));
                            echo $selectPseudo->fetch()[0].'<br>';
                          }
                          ?>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <?php } }}?>
              </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
    function supprimer(user_id, group_id) {
      let xhttp = new XMLHttpRequest();

       xhttp.onreadystatechange = function() {
         if (xhttp.readyState == 4 && xhttp.status == 200) {
           console.log(xhttp.responseText);
               alert('Utilisateur bien supprimé !');
             }
       }

       xhttp.open('GET', 'ajax_supprimer.php?user_id=' + user_id + '&group_id='+group_id);
       xhttp.send();
     }
    </script>
  </body>
</html>
