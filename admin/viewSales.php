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
  <link rel="stylesheet" href="css/simple-sidebar.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/shop.css">
  <title>Consulter les achats | Shop | Sporters</title>
</head>
  <body>
    <?php include ('../libs/php/headers/admDashHeader.php'); ?>
    <main>
      <div class="container-fluid filledSection">
        <div class="container bg-light filledContainer">
          <h1>Consulter les achats</h1>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Date</th>
                <th scope="col">Prix</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>

              <?php
              
              include('../libs/php/db/db_connect.php');

              $querySales = $conn->prepare('SELECT * FROM orders');
              $querySales->execute();
              $totalSales = $querySales->fetchAll();
              $totalOrders = count($totalSales);

              foreach ($totalSales as $sale):

                $queryMore = $conn->prepare('SELECT * FROM users WHERE userId = ?');
                $queryMore->execute([$sale['order_userId']]);
                $user = $queryMore->fetch();

                $queryMore = $conn->prepare('SELECT * FROM products WHERE productID = ?');
                $queryMore->execute([$sale['order_productId']]);
                $product = $queryMore->fetch();
                ?>

                <tr class="sale_row" data-toggle="modal" data-target="#sale<?php echo $sale['order_id']; ?>">
                <th scope="row"><?php echo $sale['order_token']; ?></th>
                <td><?php echo $user['pseudo']; ?></td>
                <td><?php echo $product['productName']; ?></td>
                <td><?php echo $totalOrders; ?></td>
                <td><?php echo $sale['order_date']; ?></td>
                <td><?php echo $product['productPrice']; ?> €</td>
                <td>
                    <div class="modal fade" id="sale<?php echo $sale['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="sale<?php echo $sale['order_id']; ?>">Vente n° 1</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            ...
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>                  
                </td>
                </tr>

                <?php endforeach; ?>

            </tbody>
          </table>


        </div>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
