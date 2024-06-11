<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="#">Administration</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php">Produits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Commentaires</a>
        </li>
        </ul>
        <ul class="navbar-nav ms-auto me-5">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $_SESSION['login'] ?>
              </a>
              <ul class="dropdown-menu me-5">
                <li><a class="dropdown-item" href="dashboard.php?deco=ok">déconnexion</a></li>
              </ul>
            </li>
        </ul>
    </div>
  </div>
</nav>