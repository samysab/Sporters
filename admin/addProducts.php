<?php
  include('functions/functions.php');
  hasAccess();
  include('../libs/php/db/db_connect.php');

  // var_dump($_POST);

  if (isset($_POST['addProd']) && !empty($_POST['addProd'])) {
    // var_dump([$_POST['nom'], $_POST['marque'], $_POST['type'], $_POST['genre'], $_POST['stock'], $_POST['prix'], $_POST['score'], $_POST['sport'], $_POST['description']]);
    $marque = isset($_POST['marque']) ? htmlspecialchars($_POST['marque'], ENT_QUOTES) : htmlspecialchars($_POST['marquetext'], ENT_QUOTES);
    $sport = isset($_POST['sport']) ? htmlspecialchars($_POST['sport'], ENT_QUOTES) : htmlspecialchars($_POST['sporttext'], ENT_QUOTES);



    if (isset($_POST['nom']) && !empty($_POST['nom']) && !empty($marque) && !empty($sport)
     && isset($_POST['type']) && !empty($_POST['type']) && isset($_POST['genre']) && !empty($_POST['genre'])
      && isset($_POST['stock']) && !empty($_POST['stock']) && isset($_POST['prix']) && !empty($_POST['prix'])
       && isset($_POST['score']) && !empty($_POST['score']) && isset($_POST['description']) && !empty($_POST['description'])) {

      $nom = htmlspecialchars($_POST['nom']);
      // $marque = htmlspecialchars($_POST['marquetext'], ENT_QUOTES);
      $type = htmlspecialchars($_POST['type'], ENT_QUOTES);
      $genre = htmlspecialchars($_POST['genre'], ENT_QUOTES);
      $stock = intval(htmlspecialchars($_POST['stock'], ENT_QUOTES));
      $prix = floatval(htmlspecialchars($_POST['prix'], ENT_QUOTES));
      $score = floatval(htmlspecialchars($_POST['score'], ENT_QUOTES));
      // $sport = htmlspecialchars($_POST['sport'], ENT_QUOTES);
      $description = htmlspecialchars($_POST['description']);

      // var_dump([$nom, $type, $genre, $stock, $prix, $score, $description, $sport, $marque]);

      if ( (strlen(trim($nom)) > 80) || (strlen(trim($marque)) > 45) ||
            (strlen(trim($type)) > 45) || !is_int($stock) > 80 || !is_float($prix) || !is_float($score) ||
             (strlen(trim($description)) > 400) || preg_match('~[0-9]~', $sport) ||
            strlen(trim($sport)) > 45
        ) {
        $errors['policy'] = "Le formulaire contient des erreurs";
      } else {

        // images
        $dir = '../ressources/images/products/';

        $array_tmp_name;
        $array_name;

          $array_tmp_name = $_FILES['image']['tmp_name'];
          $array_name = $_FILES['image']['name'];

          move_uploaded_file($_FILES['image']['tmp_name'], $dir.$_FILES['image']['name']);
          
        $queryInsert = $conn->prepare('INSERT INTO products(productName, productBrand, productType, productGender, productStock, productPrice, productScore, productSport, productDescription, productImg) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $res = $queryInsert->execute([$nom, $marque, $type, $genre, $stock, $prix, $score, $sport, $description, $array_name]);

        if ($res) {
            $success = "Produit ajouté avec succès";
        } else {
          $errors['fail'] = "L'insertion n'a pas reussie";
        }

      }

    } else {
      $errors['empty'] = "Tous les champs doivent etre remplis";
    }
  }






?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/shop.css">
  <title>Ajouter un produit | Shop | Sporters</title>
</head>
  <body>
    <?php include ('../libs/php/headers/admDashHeader.php'); ?>
    <main>
      <div class="container-fluid filledSection">
        <div class="container bg-light filledContainer">
          <h1>Ajouter un produit</h1>
          <div class="container-fluid">
              <?php if (isset($success)) {
                echo '<div class="alert alert-success col-md-12" role="success" style="margin-top: 20px; text-align: center;">'.$success.'</div>';
              } else if (isset($errors)) {
                foreach ($errors as $err) {
                echo '<div class="alert alert-danger col-md-12" role="danger" style="margin-top: 20px; text-align: center;">'.$err.'</div>';

                }

              }?>
            <div class="content_container">
              <aside class="product_container">
                <form action method="POST" enctype="multipart/form-data">

                  <input type="text" class="product_input" placeholder="Nom" name="nom" value="<?php if (isset($_POST['nom']))echo $_POST['nom']; ?>">

                  <div class="product_or">
                    
                    <select style="display: none" class="product_input inp" name="marque">
                    <?php
                      $queryBrands = $conn->prepare('SELECT productBrand FROM products');
                      $queryBrands->execute();
                      $fullBrands = [];
                      while ($brand = $queryBrands->fetch()) {
                        $fullBrands[] = $brand[0];
                      }

                      $categories = array_unique($fullBrands);

                      foreach($categories as $cat) { ?>
                        <option value="<?php echo $cat ?>"><?php echo $cat ?></option>
                    <?php } ?>
                    </select>

                    <input type="text" class="product_input inp" placeholder="Marque" name="marquetext" value="<?php if (isset($_POST['marquetext']))echo $_POST['marquetext']; ?>">
                  
                    <button type="button" id="ci1" onclick="changeInput1()" class="product_input type_change"><img src="../ressources/images/switch.png" width="25" height="25" /></button>
                  
                  </div>


                  <input type="text" class="product_input" placeholder="Type" name="type" value="<?php if (isset($_POST['type']))echo $_POST['type']; ?>">

                  <select class="product_input" name="genre">
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                  </select>
                  <input type="text" class="product_input" placeholder="Stock" name="stock" value="<?php if (isset($_POST['stock']))echo $_POST['stock']; ?>">
                  <input type="text" class="product_input" placeholder="Prix" name="prix" value="<?php if (isset($_POST['prix']))echo $_POST['prix']; ?>">
                  <input type="text" class="product_input" placeholder="Score" name="score" value="<?php if (isset($_POST['score']))echo $_POST['score']; ?>">
                  <input type="file" name="image" class="product_input">

                  <div class="product_or">                  
                    <select style="display: none" class="product_input inp" name="sport">
                    <?php
                      $querySports = $conn->prepare('SELECT productSport FROM products');
                      $querySports->execute();
                      $fullSports = [];
                      while ($product = $querySports->fetch()) {
                        $fullSports[] = $product[0];
                      }

                      $categories = array_unique($fullSports);

                      foreach($categories as $cat) { ?>
                        <option value="<?php echo $cat ?>"><?php echo $cat ?></option>
                    <?php } ?>
                    </select>

                    <input class="product_input inp" type="text" name="sporttext" placeholder="Sport" value="<?php if (isset($_POST['sporttext']))echo $_POST['sporttext']; ?>">

                    <button type="button" id="ci2" onclick="changeInput2()" class="product_input type_change"><img src="../ressources/images/switch.png" width="25" height="25" /></button>

                  </div>

                  <textarea class="product_input" placeholder="Description" name="description"><?php if (isset($_POST['description']))echo $_POST['description']; ?></textarea>

                  <input type="submit" name="addProd" class="product_input" value="Ajouter le produit">
                <form>
              </aside>

            </div>
          </div>
        </div>
      </div>
    </main>


    <script>
      let mq_select = document.querySelector('select[name="marque"]');
      let mq_input = document.querySelector('input[name="marquetext"]');

      let sp_select = document.querySelector('select[name="sport"]');
      let sp_input = document.querySelector('input[name="sporttext"]');
      
      let c1 = 1;
      let c2 = 1;
  

        // function changeInput(a, b, c) {
      function changeInput1() {
        if (c1) {
          mq_select.style.display = "inline-block";
          mq_input.style.display = "none";
          mq_input.value = "";
          c1 = 0;
        } else {
          mq_select.style.display = "none";
          mq_input.style.display = "inline-block";
          c1 = 1;
        }
      }   


      function changeInput2() {
        if (c2) {
          sp_select.style.display = "inline-block";
          sp_input.style.display = "none";
          sp_input.value = "";
          c2 = 0;
        } else {
          sp_select.style.display = "none";
          sp_input.style.display = "inline-block";
          c2 = 1;
        }
      }

      // ci =  change input
      // let ci2 = document.getElementById('ci2');
      // ci2.addEventListener('click', function() {
      //   changeInput(sp_select, sp_input, c2);
      //   console.log(c2);
      // });

    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
