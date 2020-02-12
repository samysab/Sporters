<?php
include('libs/php/db/db_connect.php');
if (isset($_GET['user_id']) && isset($_GET['group_id']) && !empty($_GET['group_id']) && !empty($_GET['user_id']) ) {
  $requeteSupprime =$conn->prepare('DELETE FROM groups_history WHERE users_userId = ? AND groups_groupId = ?');
  $requeteSupprime ->execute(array(
    $_GET['user_id'],
    $_GET['group_id']
  ));
}
 ?>
