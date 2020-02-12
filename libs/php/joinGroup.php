<?php
  if (isset($_POST['button_joinGroup'])) {
      $req = 'INSERT INTO groups_history VALUES (?,?,?)';
      $q = $conn->prepare($req);
      $q->execute(array(
      $_SESSION['user'][0],
      $_SESSION['user'][1],
      $_POST['groupeIdinput']
      ));
}
 ?>


<!-- Join Groups -->
<?php
  $requete = $conn->prepare('SELECT * FROM groups WHERE users_userId = ?');
  $res = $requete->execute(array(
    $_SESSION['user']['userId']
  ));
  $rows = $requete->rowCount();
  if (!$rows) {
?>
 <?php
}else {
  echo '<div class="alert alert-danger col-md-12" role="alert" style="margin-top: 20px; text-align: center;">' . 'Pour rejoindre un groupe vous devez d\'abord quitter votre groupe !'. '</div>';
}
?>
<!-- Modal -->
<div class="modal fade" id="joinGroups" tabindex="-1" role="dialog" aria-labelledby="joinGroupsModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="joinGroupsModalTitle">Rejoindre un groupe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Voir les groupes -->

        <?php
        $show = $conn->prepare('SELECT * FROM groups');
        $show->execute();
        while ($gr = $show->fetch()){
          echo '<form method="POST" name="formJoin" action="">';
          echo '<p>' . $gr['groupName'].'   ' .  $gr['groupSport'] . '<input name="groupeIdinput" type="hidden" value="'. $gr['groupId'].'"> <input type="submit" name="button_joinGroup" class="btn btn-outline-success">';
          echo '</form>';
        }
         ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>
