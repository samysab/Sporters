<?php
session_start();
if (isset($_POST['forminscription'])) {

  $nom = htmlspecialchars($_POST['nom']);
  $prenom = htmlspecialchars($_POST['prenom']);
  $mail = htmlspecialchars($_POST['mail']);
  $mdp = htmlspecialchars($_POST['mdp']);
  $mdp2 = htmlspecialchars($_POST['mdp2']);
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $captcha = htmlspecialchars($_POST['captcha']);

  if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['pseudo']) AND !empty($_POST['captcha'])) {

	$nomlenght = strlen($nom);
	$prenomlength = strlen($prenom);
	$pseudolength = strlen($pseudo);

	if ($nomlenght <= 255) {
	  if ($pseudolength <=15) {
		    if ($prenomlength <= 255) {



			if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			  if ($mdp == $mdp2) {
				include('db/db_connect.php');

        $loginQuery = $conn->prepare("SELECT * FROM users WHERE email = ?");

        $res = $loginQuery->execute([$mail]);

        $rows = $loginQuery->rowCount();

        if ($rows) {
          $user = $loginQuery->fetch();
          header('Location: ../../signup.php?error=email_exist');
          exit;
        }
        if($captcha != $_SESSION['captcha']) {
           header('location: ../../signup.php?signup=invalid_captcha'); // captcha
           exit;
        }
				$insertmbr = $conn->prepare("INSERT INTO users(lastname, firstname, pseudo, email, password, confirmationToken, accountStatus) VALUES(?, ?, ?, ?, ?, ?, ?)");

				$password = hash('sha256', $mdp);

		        include('functions.php');
				$token = str_random(60);

				$insertmbr->execute(array($nom, $prenom, $pseudo, $mail, $password, $token, 0));

				$lastId = $conn->lastInsertId();

				mail($mail, "Sporters - Confirmez votre compte", "Afin de valider votre inscription, veuillez <a href=\"http://51.75.201.92/confirm.php?id=".$lastId."&token=".$token."\">confirmer votre compte</a>");
				header('Location: ../../index.php?inscription=success');
				// $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
			  }
			  else {
        header('Location:../../signup.php?signup=passerror');
        exit;
			  }
			}
			else {
        header('Location:../../signup.php?signup=invalid_email');
        exit;
			}
		}
		else {
      header('Location:../../signup.php?signup=name_length');
      exit;
		}
	  }
	  else {
    header('Location:../../signup.php?signup=pseudolength');
    exit;
    }
	}
	else {
    header('Location:../../signup.php?signup=lastname_length');
    exit;
	}
  }
  else {
  header('Location:../../signup.php?signup=field_blank');
  exit;

  }
}
 ?>
