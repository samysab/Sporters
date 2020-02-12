<?php
  include('functions/functions.php');
  hasAccess();
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
  <title>Lister les produits | Shop | Sporters</title>
    <script>

      // send2update va charger les parametres du produit cliqued dans les inputs du formulaire
      function setValue(input, data) {
        document.getElementById(input).value = data;
      }

      function send2update(e) {

        // document.getElementById('updateStatus').innerHTML = '';
        // let name;
        // if (typeof e == "string")
        //   name = e;
        // else
        //   name = e.innerHTML;

        let name = (typeof e == "string") ? e : e.innerText;

        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            // on recupere la ligne du produit cliqué sous forme de tableau

            let product = JSON.parse(this.responseText);
            // on va faire correspondre le tableau aux input
            // nom
            // let inputsName = [
            // 'inputNom',
            // 'inputMarque',
            // 'inputType',
            // 'inputGenre',
            // 'inputStock',
            // 'inputPrix',
            // 'inputScore',
            // 'inputDescription'];
            // for (let i = 0; i < inputsName.length-1; i++) {
            //   setValue(inputsName[i], product[1+i]);
            // }

            // setValue('inputDescription', product[7])

            // ou //
            setValue('inputNom', product[1]);
            setValue('inputMarque', product[2]);
            setValue('inputType', product[3]);
            setValue('inputGenre', product[4]);
            setValue('inputStock', product[5]);
            setValue('inputPrix', product[6]);
            setValue('inputDescription', product[7]);
            setValue('inputSport', product[8]);
            setValue('inputScore', product[9]);

            // let imgArray = JSON.parse(product[10]);
            let imgArray = product[10];
            document.getElementsByClassName('carousel-inner')[0].innerHTML = "";
            // for (let i = 0; i < imgArray.length; i++) {
              document.getElementsByClassName('carousel-inner')[0].innerHTML += '<div class="carousel-item"><img class="d-block w-80" src="../ressources/images/products/'+imgArray+'" width="165" height="165" alt="First slide"></div>';
            // }

            document.getElementsByClassName('carousel-inner')[0].firstElementChild.className += ' active';

            // on attribue l'id du produit cliqued au submit pour permettre la maj
            document.getElementById('updateInput').setAttribute('data-productId', product[0]);
            document.getElementById('removeInput').setAttribute('data-productId', product[0]);

          }
        };

        xhttp.open('GET', 'mirrors/mirror.php?productName='+name, true);
        xhttp.send();
      }


      let url = new URL(window.location);
      let param = url.searchParams.get('modifier');
      if (param != null) {
        send2update(param);
      }


      function getValue(input) {
        return document.getElementById(input).value;
      }

      // update va appliquer les changements faits, a la bdd
      function update() {
        let id = document.getElementById('updateInput').getAttribute('data-productId');
        let xhttp = new XMLHttpRequest();
        let product = [];

        product.push(getValue('inputNom'));
        product.push(getValue('inputMarque'));
        product.push(getValue('inputType'));
        product.push(getValue('inputGenre'));
        product.push(getValue('inputStock'));
        product.push(getValue('inputPrix'));
        product.push(getValue('inputScore'));
        product.push(getValue('inputSport'));
        product.push(getValue('inputDescription'));
        product.push(getValue('imgInput'));
        
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {

            document.getElementById('updateStatus').innerHTML = '<div class="alert alert-success col-md-12" role="success" style="margin-top: 20px; text-align: center;">Produit mis à jour avec succès</div>';
          } else {
            // document.getElementById('updateStatus').innerHTML = '<div class="alert alert-danger col-md-12" role="danger" style="margin-top: 20px; text-align: center;">Erreur</div>';

          }
        };
        console.log('mirrors/mirrorUpdate.php?id='+id+'&product='+product);
        xhttp.open('GET', 'mirrors/mirrorUpdate.php?id='+id+'&product='+product, true);
        xhttp.send();
      }

      function remove() {
        let idr = document.getElementById('removeInput').getAttribute('data-productId');
        let xhttpr = new XMLHttpRequest();
        xhttpr.onreadystatechange = function() {
          if (xhttpr.readyState == 4) {
            if (xhttpr.responseText) {
              document.getElementById('updateStatus').innerHTML = '<div class="alert alert-success col-md-12" role="success" style="margin-top: 20px; text-align: center;">Produit supprimé avec succès</div>';
            }

          }
        }

        xhttpr.open('GET', 'mirrors/mirror.php?productRemoveId='+idr, true);
        xhttpr.send();

      }



    </script>
</head>
  <body>
    <?php include ('../libs/php/headers/admDashHeader.php'); ?>
    <main>
      <div class="container-fluid filledSection">
        <div class="container bg-light filledContainer">
          <h1>Afficher les produits</h1>
          <div class="container-fluid">

            <div class="content_container">
              <ul class="list-unstyled components root_ul">
                <!-- <p>Dummy Heading</p> -->

                <?php

                include('../libs/php/db/db_connect.php');

                $queryCategories = $conn->prepare('SELECT productSport FROM products');
                $queryCategories->execute();
                $fullCat = [];
                while ($product = $queryCategories->fetch()) {
                  $fullCat[] = $product[0];
                }

                $categories = array_unique($fullCat);

                // lister les Categories de sport
                foreach($categories as $cat) { ?>

                  <li class="active">
                    <a href="#home<?php echo $cat; ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $cat; ?></a>
                    <ul class="collapse list-unstyled di_1" id="home<?php echo $cat; ?>">
                      <ul class="list-unstyled components">

                      <?php

                      // lister les types de produits
                      $queryTypes = $conn->prepare('SELECT productType FROM products WHERE productSport = ?');
                      $queryTypes->execute([$cat]);
                      $fullTypes = [];
                      while ($type = $queryTypes->fetch())
                        $fullTypes[] = $type[0];

                      $types = array_unique($fullTypes);

                      foreach($types as $type) { ?>

                      <li class="active">
                        <a href="#home<?php echo $cat.$type; ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $type; ?></a>
                        <ul class="collapse list-unstyled di_2" id="home<?php echo $cat.$type; ?>">

                          <?php
                          $queryProds = $conn->prepare('SELECT productName FROM products WHERE productType = ?');
                          $queryProds->execute([$type]);

                          // var_dump($queryProds->fetch());
                          while ($prod = $queryProds->fetch()) { ?>

                            <li>
                                <a href="#" onclick="send2update(this)"><?php echo $prod[0]; ?></a>
                            </li>

                          <?php } ?>
                        </ul>
                      </li>


                      <?php } ?>


                      </ul>
                    </ul>
                  </li>

                <?php } ?>
              </ul>

              <aside class="product_container">
                <div class="product_img_container">
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                    </div>
                  </div>
<!--                   <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a> -->
                </div>

                <input type="text" id="inputNom" class="product_input" placeholder="Nom">

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

                  <input type="text" class="product_input inp" placeholder="Marque" name="marquetext" id="inputMarque" value="<?php if (isset($_POST['marquetext']))echo $_POST['marquetext']; ?>">
                
                  <button type="button" id="ci1" onclick="changeInput1()" class="product_input type_change"><img src="../ressources/images/switch.png" width="25" height="25" /></button>
                
                </div>

                <input type="text" id="inputType" class="product_input" placeholder="Type">
                <input type="text" id="inputGenre" class="product_input" placeholder="Genre">


                <input type="text" id="inputStock" class="product_input" placeholder="Stock">
                <input type="text" id="inputPrix" class="product_input" placeholder="Prix">
                <input type="text" id="inputScore" class="product_input" placeholder="Score">

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

                    <input class="product_input inp" type="text" name="sporttext" id="inputSport" placeholder="Sport" value="<?php if (isset($_POST['sporttext']))echo $_POST['sporttext']; ?>">

                    <button type="button" id="ci2" onclick="changeInput2()" class="product_input type_change"><img src="../ressources/images/switch.png" width="25" height="25" /></button>

                  </div>

                <textarea class="product_input" id="inputDescription" placeholder="Description"></textarea>

                <input type="file" name="image" class="product_input" id="imgInput">

                <input type="submit" class="product_input alert-primary" value="Mettre à jour" data-productId="" id="updateInput" onclick="update()">
                <input type="submit" class="product_input alert-danger" value="Supprimer" data-productId="" id="removeInput" onclick="remove()">
                <p id="updateStatus"></p>
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
          mq_input.value = "";
          c2 = 0;
        } else {
          sp_select.style.display = "none";
          sp_input.style.display = "inline-block";
          c2 = 1;
        }
      }


    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
