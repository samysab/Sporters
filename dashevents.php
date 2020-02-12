<?php
include('libs/functions/functions.php');
include('libs/php/db/db_connect.php');
include('libs/functions/isVerified.php');
include('libs/functions/selectUserInfos.php');

if (!isConnected()) {
  header('Location: login.php');
}

isVerified($_SESSION["user"]["userId"]);

if (isset($_GET["delevent"]) && !empty($_GET["delevent"])) {
  $delevent = (int) $_GET["delevent"];
  $delete_event = $conn->prepare('DELETE FROM events WHERE enventId = ?');
  $delete_event->execute(array($delevent));
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
                  <!-- Ligne contenant les messages d'erreur -->
                  <div class="row">
                    <div class="container">
                      <?php include('libs/functions/eventCreationErrors.php'); ?>
                    </div>
                  </div>
                  <?php
                  if ($result["membershipStatus"] == 1) {
                    include('libs/php/createEventBtn.php');
                  }
                  include('libs/php/joinEventBtn.php');
                  ?>
                  <hr>
                  <h1 class="title"><i class="fa fa-calendar"></i> Mes Events crées</h1>
                  <!-- Affichage des Events crées par l'user -->
                  <div class="accordion" id="accordionExample">
                    <?php
                    $q = "SELECT * FROM events WHERE users_userId = ?";
                    $request = $conn->prepare($q);
                    $request->execute([$_SESSION["user"]["userId"]]);
                    while($res = $request->fetch()){
                    ?>
                    <div class="card">
                      <div class="card-header" id="card<?php echo $res["enventId"]; ?>">
                        <h2 class="mb-0">
                          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse<?php echo $res["enventId"]; ?>"
                            aria-expanded="true" aria-controls="collapse<?php echo $res["enventId"]; ?>">
                            <?php echo $res["eventName"]; ?>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse<?php echo $res["enventId"]; ?>" class="collapse" aria-labelledby="heading<?php echo $res["enventId"]; ?>"
                        data-parent="#accordionExample">
                        <div class="card-body">
                          <?php include("libs/php/deleteEventBtn.php"); ?>
                          <form>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="dateInput">Date</label>
                                <input type="text" id="dateInput" class="form-control" name="eventDate"
                                value="<?php echo $res["eventDate"]; ?>" readonly>
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="sportInput">Sport</label>
                                <input type="text" id="sportInput" class="form-control" name="eventSport"
                                value="<?php echo $res["eventSport"]; ?>" readonly>
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="slotsInput">Places</label>
                                <input type="text" id="slotsInput" class="form-control" name="eventSlot"
                                value="<?php echo $res["eventSlot"]; ?>" readonly>
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="fieldInput">Terrain</label>
                                <input type="text" id="fieldInput" class="form-control" name="eventField"
                                value="<?php echo $res["fields_fieldAddress"]; ?>" readonly>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>

                  <hr>

                  <h1 class="title"><i class="fa fa-calendar"></i> Mes Events</h1>
                  <!-- Affichage des Events crées par l'user -->
                  <div class="accordion" id="accordionExample">
                    <?php
                    $q = "SELECT events_eventId, eventId, eventName, eventDate, eventSport, eventSlot, eventPrice, fields_fieldAddress FROM events_history INNER JOIN events ON events_history.events_eventId = events.eventId WHERE events_history.users_userId = ?";
                    $request = $conn->prepare($q);
                    $request->execute([$_SESSION["user"]["userId"]]);
                    while($res = $request->fetch()){
                    ?>
                    <div class="card">
                      <div class="card-header" id="card<?php echo $res["enventId"]; ?>">
                        <h2 class="mb-0">
                          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse<?php echo $res["enventId"]; ?>"
                            aria-expanded="true" aria-controls="collapse<?php echo $res["enventId"]; ?>">
                            <?php echo $res["eventName"]; ?>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse<?php echo $res["enventId"]; ?>" class="collapse" aria-labelledby="heading<?php echo $res["enventId"]; ?>"
                        data-parent="#accordionExample">
                        <div class="card-body">
                          <?php include("libs/php/deleteEventBtn.php"); ?>
                          <form>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="dateInput">Date</label>
                                <input type="text" id="dateInput" class="form-control" name="eventDate"
                                value="<?php echo $res["eventDate"]; ?>" readonly>
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="sportInput">Sport</label>
                                <input type="text" id="sportInput" class="form-control" name="eventSport"
                                value="<?php echo $res["eventSport"]; ?>" readonly>
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="slotsInput">Places</label>
                                <input type="text" id="slotsInput" class="form-control" name="eventSlot"
                                value="<?php echo $res["eventSlot"]; ?>" readonly>
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="fieldInput">Terrain</label>
                                <input type="text" id="fieldInput" class="form-control" name="eventField"
                                value="<?php echo $res["fields_fieldAddress"]; ?>" readonly>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
