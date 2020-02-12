<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">
      <img src="../ressources/images/sporters_logo.png" alt="sporters_logo" width="100px" height="50px">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="viewUsers.php">Membres</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="viewGroups.php">Groupes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="viewFields.php">Terrains</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="viewGames.php">Parties</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="viewEvents.php">Events</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Siteweb
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="faq_manager.php">FAQ</a>
            <a class="dropdown-item" href="cgu_manager.php">CGU</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Boutique
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="viewSales.php">Consulter achats</a>
            <a class="dropdown-item" href="viewProducts.php">Lister produits</a>
            <a class="dropdown-item" href="addProducts.php">Ajouter produits</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php print_r($_SESSION["admin"]["adminPseudo"]); ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="addAdmin.php">Paramètres</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">Deconnexion</a>
          </div>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" id="searchParent">
        <input id="searchInput" onfocus="showResBox()" onkeyup="search(this)" class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search">

        <ul id="searchResBox" class="list-group">
          <li class="list-group-item active">
            <span>Utilisateurs</span>
            <ul class="list-group searchResRows" id="UsersRow"></ul>

          </li>

          <li class="list-group-item active">
            <span>Parties</span>
            <ul class="list-group searchResRows" id="GamesRow"></ul>

          </li>

          <li class="list-group-item active">
            <span>Produits</span>
            <ul class="list-group searchResRow" id="ProductsRow"></ul>

          </li>

          <li class="list-group-item active">
            <span>Terrains</span>
            <ul class="list-group searchResRows" id="FieldsRow"></ul>

          </li>


        </ul>

        <button class="btn btn-success my-2 my-sm-0" type="submit">Chercher</button>
      </form>
    </div>
  </nav>
</header>

<script src="functions/search.js"></script>
