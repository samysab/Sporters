<?php

// Fonction de vérification et d'assainnissementdes inputs
function check_input($data){
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
