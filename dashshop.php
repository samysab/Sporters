<?php
include('libs/functions/functions.php');
include('libs/php/db/db_connect.php');
include('libs/functions/selectUserInfos.php');

function setCategories($catName, $column) {
  global $conn;
  $queryCategories = $conn->prepare('SELECT ' . $column . ' FROM products');
  $queryCategories->execute();

  $fullCategories = [];
  while ($category = $queryCategories->fetch()) {
    $fullCategories[] = $category[0];
  }

  $categories = array_unique($fullCategories);

  echo '<h5>Par ' . $catName . '</h5>';
  echo '<ul class="list-group">';
  foreach ($categories as $value) {
    $queryGetNbOf = $conn->prepare('SELECT 1 FROM products WHERE ' . $column . ' = "' . $value . '"');
    $queryGetNbOf->execute();
    $rows = $queryGetNbOf->rowCount();
    echo '<form action="" method="GET">
    <input type="hidden" name="colonne" value="'.$column.'">
    <input type="hidden" name="rowdata" value="'.$value.'">
    <li class="list-group-item d-flex justify-content-between align-items-center" onclick="addFilter(this)">' . 
      $value . 
    '<span class="badge badge-primary badge-pill">' . $rows . '</span></li></form>';
  }
  echo '</ul>';
}


if (!isConnected()) {
  header('Location: login.php');
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
            <div class="container">
              <div class="row">
                <div class="container bg-light filledContainer">
                  <!-- ici -->
                  <div class="container-fluid">
                    <div class="row col-lg-12">
                      <div class="d-flex flex-column col-lg-3">                        
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger mb-3" data-toggle="modal" data-target="#panier">
                          Voir mon panier
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="panier" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Mon Panier</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                
                                <h6>Mes produits</h6>

                                <table class="table table-hover">
                                  <thead class="thead-dark">
                                    <tr>
                                      <td>Produit</td>
                                      <td>Prix</td>
                                    </tr>
                                  </thead>
                                  <tbody id="tbody" class="table-striped">
                                    <tr class="table-success">
                                      <td>
                                        <span>Total:</span>
                                      </td>
                                      <td><span id="prixTotal">0</span> €</td>
                                    </tr>
                                  </tbody>
                                </table>                                

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Continuer mes achats</button>
                                <button type="button" class="btn btn-primary" onclick="buy(this)">Acheter</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php

                        setCategories('Sport', 'productSport');
                        setCategories('Marque', 'productBrand');
                        setCategories('Genre', 'productGender');
                        
                        
                        if (!$_SESSION['user']['membershipStatus']) { ?>
                        <h5>Abonnement Premium</h5>
                        <button class="btn btn-primary" onclick="buy_premium()">Acheter</button>
                        <?php } else { ?>
                        <h5>Vous êtes un membre Premium</h5>
                        <?php } ?>

                      </div>

                      <div class="row col-lg-9">
                        <div class="card-group">

                          <?php

                          // s'il n'y a pas de recherche personnalisee, on affiche les 5 derniers elements
                          if (!empty($_GET)) {
                            $col = htmlspecialchars($_GET['colonne'], ENT_QUOTES);
                            $row = htmlspecialchars($_GET['rowdata'], ENT_QUOTES);
                            $queryFilteredSearch = $conn->prepare('SELECT * FROM products WHERE ' . $col . ' = ? ORDER BY productID DESC LIMIT 6');
                            $queryFilteredSearch->execute([$row]);
                            $filterAllProds = $queryFilteredSearch->fetchAll();
                            $allProdsCount = count($filterAllProds);
                            foreach ($filterAllProds as $key => $product) {
                              switch ($key % 3) {
                                case 0: ?>
                                  <div class="card col-<?php echo ceil(intval(12/$allProdsCount))+1; ?>">
                                    <img class="card-img-top" src="ressources/images/products/<?php echo explode('.png', $product['productImg'])[0] . '.png'; ?>" alt="Card image cap">
                                    <div class="card-body">
                                      <h5 class="card-title"><?php echo $product['productName']; ?></h5>
                                      <p class="card-text"><?php echo $product['productDescription']; ?></p>
                                      <p class="card-text"><i>Prix : <?php echo $product['productPrice']; ?> €</i></p>
                                      <button class="btn btn-success" onclick="addProduct(this)" data-price="<?php echo $product['productPrice']; ?>" data-name="<?php echo $product['productName']; ?>" data-id="<?php echo $product['productID']; ?>">Ajouter</button>
                                    </div>
                                  </div><?php
                                  break;
                                
                                case 1: ?>
                                  <div class="card col-<?php echo ceil(intval(12/$allProdsCount))+1; ?>">
                                    <img class="card-img-top" src="ressources/images/products/<?php echo explode('.png', $product['productImg'])[0] . '.png'; ?>" alt="Card image cap">
                                    <div class="card-body">
                                      <h5 class="card-title"><?php echo $product['productName']; ?></h5>
                                      <p class="card-text"><?php echo $product['productDescription']; ?></p>
                                      <p class="card-text"><i>Prix : <?php echo $product['productPrice']; ?> €</i></p>
                                      <button class="btn btn-success" onclick="addProduct(this)" data-price="<?php echo $product['productPrice']; ?>" data-name="<?php echo $product['productName']; ?>" data-id="<?php echo $product['productID']; ?>">Ajouter</button>
                                    </div>
                                  </div><?php
                                  break;
                                
                                case 2: ?>
                                  <div class="card col-<?php echo ceil(intval(12/$allProdsCount))+1; ?>">
                                    <img class="card-img-top" src="ressources/images/products/<?php echo explode('.png', $product['productImg'])[0] . '.png'; ?>" alt="Card image cap">
                                    <div class="card-body">
                                      <h5 class="card-title"><?php echo $product['productName']; ?></h5>
                                      <p class="card-text"><?php echo $product['productDescription']; ?></p>
                                      <p class="card-text"><i>Prix : <?php echo $product['productPrice']; ?> €</i></p>
                                      <button class="btn btn-success" onclick="addProduct(this)" data-price="<?php echo $product['productPrice']; ?>" data-name="<?php echo $product['productName']; ?>" data-id="<?php echo $product['productID']; ?>">Ajouter</button>
                                    </div>
                                  </div>
                                </div><?php
                                  break;
                              }
                            }
                            if (count($filterAllProds) > 3 && count($filterAllProds) < 6) {
                              echo '</div>';
                            }

                          } else {
                            $queryProds = $conn->prepare('SELECT * FROM products ORDER BY productID DESC LIMIT 6');
                            $queryProds->execute();
                            $allProds = $queryProds->fetchAll();
                            $allProdsCount = count($allProds);
                            foreach ($allProds as $key => $product) {
                              switch ($key % 3) {
                                case 0: ?>
                                  <div class="card col-<?php echo ceil(intval(12/$allProdsCount))+1; ?>">
                                    <img class="card-img-top" src="ressources/images/products/<?php echo explode('.png', $product['productImg'])[0] . '.png'; ?>" alt="Card image cap">
                                    <div class="card-body">
                                      <h5 class="card-title"><?php echo $product['productName']; ?></h5>
                                      <p class="card-text"><?php echo $product['productDescription']; ?></p>
                                      <p class="card-text"><i>Prix : <?php echo $product['productPrice']; ?> €</i></p>
                                      <button class="btn btn-success" onclick="addProduct(this)" data-price="<?php echo $product['productPrice']; ?>" data-name="<?php echo $product['productName']; ?>" data-id="<?php echo $product['productID']; ?>">Ajouter</button>
                                    </div>
                                  </div><?php
                                  break;
                                
                                case 1: ?>
                                  <div class="card col-<?php echo ceil(intval(12/$allProdsCount))+1; ?>">
                                    <img class="card-img-top" src="ressources/images/products/<?php echo explode('.png', $product['productImg'])[0] . '.png'; ?>" alt="Card image cap">
                                    <div class="card-body">
                                      <h5 class="card-title"><?php echo $product['productName']; ?></h5>
                                      <p class="card-text"><?php echo $product['productDescription']; ?></p>
                                      <p class="card-text"><i>Prix : <?php echo $product['productPrice']; ?> €</i></p>
                                      <button class="btn btn-success" onclick="addProduct(this)" data-price="<?php echo $product['productPrice']; ?>" data-name="<?php echo $product['productName']; ?>" data-id="<?php echo $product['productID']; ?>">Ajouter</button>
                                    </div>
                                  </div><?php
                                  break;
                                
                                case 2: ?>
                                  <div class="card col-<?php echo ceil(intval(12/$allProdsCount))+1; ?>">
                                    <img class="card-img-top" src="ressources/images/products/<?php echo explode('.png', $product['productImg'])[0] . '.png'; ?>" alt="Card image cap">
                                    <div class="card-body">
                                      <h5 class="card-title"><?php echo $product['productName']; ?></h5>
                                      <p class="card-text"><?php echo $product['productDescription']; ?></p>
                                      <p class="card-text"><i>Prix : <?php echo $product['productPrice']; ?> €</i></p>
                                      <button class="btn btn-success" onclick="addProduct(this)" data-price="<?php echo $product['productPrice']; ?>" data-name="<?php echo $product['productName']; ?>" data-id="<?php echo $product['productID']; ?>">Ajouter</button>
                                    </div>
                                  </div>
                                </div><?php
                                  break;
                              }
                            }
                            if (count($allProds) > 3 && count($allProds) < 6) {
                              echo '</div>';
                            }
                          }
                          
                          ?>

                      </div>
                    </div>
                  </div>  
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
    <script>

      function removeProduct(tr) {
        document.getElementById('prixTotal').innerHTML = parseFloat(document.getElementById('prixTotal').innerHTML) + parseFloat(tr.getAttribute('data-price'));
      }


      function addProduct(button) {
        console.log(button);
        var id = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        var price = parseFloat(button.getAttribute('data-price'));
        document.getElementById('prixTotal').innerHTML = (parseFloat(document.getElementById('prixTotal').innerHTML) + parseFloat(price)).toFixed(2); 

        var tr = document.createElement('tr');
        tr.setAttribute('data-price', price);
        tr.setAttribute('data-name', name);
        tr.setAttribute('data-id', id);
        tr.setAttribute('onclick', "removeProduct(this)");
        tr.innerHTML = '<td>'+name+'</td><td>'+price+'</td>';

        document.getElementById('tbody').insertBefore(tr, document.getElementById('tbody').childNodes[1]);

      }

      function addFilter(li) {
        li.parentNode.submit();
      }

      function buy(e) {
        var productsTab = e.parentNode.parentNode.childNodes[3].childNodes[3].childNodes[3].childNodes;
        var data = [];
        
        for (let i = 1; productsTab[i].classList.item(0) != 'table-success'; i++) {
          data.push({
            "id": productsTab[i].getAttribute('data-id'),
            "name": productsTab[i].getAttribute('data-name'),
            "price": productsTab[i].getAttribute('data-price')
          });
        }

        // console.log(data);
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200) {
            console.log(parseInt(this.responseText));
            alert('Commande passée ! Vos produits arriveront d\'ici sous peu');
            window.location.href = "index.php?achats=ok";
          }
        }

        console.log('ajax: libs/php/mirror_achats.php?data='+JSON.stringify(data) + '&userid='+<?php echo $_SESSION['user']['userId']; ?> + '&email=<?php echo $_SESSION['user']['email']; ?>');
        xhttp.open('GET', 'libs/php/mirror_achats.php?data='+JSON.stringify(data) + '&userid='+<?php echo $_SESSION['user']['userId']; ?> + '&email=<?php echo $_SESSION['user']['email']; ?>');
        xhttp.send();
      }

      function buy_premium() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200) {
            if (xhttp.responseText == "updated") {
              alert('Vous êtes maintenant un membre Premium !');
              window.location.href = "dashboard.php?account=premium";
            } else {
              // console.log("well fok");
            }
          }
        }

        xhttp.open('GET', 'libs/php/mirror_achats.php?id='+<?php echo $_SESSION['user']['userId']; ?> + '&buy_premium=1');
        xhttp.send();
      }


    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
