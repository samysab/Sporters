<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">
      <img src="ressources/images/sporters_logo.png" alt="sporters_logo" width="100px" height="50px">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Support
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="faq.php">FAQ</a>
            <a class="dropdown-item" href="cgu.php">CGU</a>
          </div>
        </li>
        <?php  if (!isConnected()) { ?>
        <li class="nav-item">
          <a class="nav-link" href="signup.php">Inscription</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Connexion</a>
        </li>
        <?php  }else{ ?>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION["user"]["pseudo"]; ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="settings.php">Profil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="libs/php/deconnexion.php">Deconnexion</a>
          </div>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Un terrain, une partie..." aria-label="Search">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Chercher</button>
      </form>
      <?php  } ?>
    </div>
  </nav>
</header>
