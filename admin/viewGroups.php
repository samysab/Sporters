<?php
  include('../libs/php/db/db_connect.php');
  include('functions/functions.php');
  hasAccess();

  if(isset($_GET['supprimer']) AND !empty($_GET['supprimer'])) {
      $supprimer = (int) $_GET['supprimer'];
      $req = $conn->prepare('DELETE FROM groups WHERE groupId = ?');
      $req->execute(array($supprimer));
   }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styleViewUsers.css">

    <title>Administration</title>
  </head>
  <body>
    <?php include('../libs/php/headers/admDashHeader.php'); ?>
    <br>
    <div class="container-fluid filledSection">
      <div class="container bg-light filledContainer">
        <h1 class="title">Les groupes :</h1>
        <hr>
        <div class="row">
          <div class="container">
              <?php
                $show = $conn->query('SELECT * FROM groups');
                echo '<div class="row">';
                while ($m = $show->fetch()){
                  $q = "SELECT users_userId FROM groups_history WHERE groups_history.groups_groupId = ? ";
                  $requests = $conn->prepare($q);
                  $requests->execute([$m['groupId']]);
                  echo '<div  class="col-md-4">';
                  echo '<p id="fiche">' . '<b>Id : </b>' . $m['groupId']. '</br>' . '<b>Nom du groupe : </b>' . $m['groupName'] .'</br>' . '<b>Sport : </b>' . $m['groupSport'].'</br>'. '<b>Joueurs dans le groupe :</b>' . '</br>';

                  while($perso = $requests->fetch()){
                    $requPseudo = 'SELECT pseudo, userId FROM users WHERE userId = ?';
                    $selectPseudo = $conn->prepare($requPseudo);
                    $selectPseudo->execute(array($perso['users_userId']));
                    while ($userId = $selectPseudo->fetch()) {
                      $group_id = $m['groupId'];
                      echo '<a  name="kickplayer" href="viewGroups.php?" data-toggle="modal" id="pseudokick" data-pseudo="'.$userId['pseudo'].'" data-target="#exampleModal" >'. $userId['pseudo'].'</a><br>';
                      //echo $selectPseudo->fetch()[0] .'<br>';
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


                <?php  }

                  ?>
                  <br>
                  <a class="btn btn-primary" id="ban" role="button" href="viewGroups.php?supprimer=<?= $m['groupId'] ?>">Supprimer</a>
                  <?php
                  echo '</p>' . '</div>';
                }
                echo '</div>';
              ?>
          </div>
        </div>
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

       xhttp.open('GET', '../ajax_supprimer.php?user_id=' + user_id + '&group_id='+group_id);
       xhttp.send();
     }
    </script>
  </body>
</html>
