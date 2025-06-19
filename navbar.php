<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"> Barber</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">


        <!-- Lien pour les clients connectés -->
        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'client'): ?>
          <li class="nav-item">
            <a class="nav-link" href="client/mes_rendezvous.php">📅 Mes rendez-vous</a>
          </li>
        <?php endif; ?>

        <!-- Lien pour les admins -->
        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
          <li class="nav-item">
            <a class="nav-link" href="admin/admin_rendezvous.php"> Gérer les rendez-vous</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin/gerer_utilisateurs.php"> Gérer les utilisateurs</a>
          </li>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav">
        <!-- Affichage login / logout -->
        <?php if (isset($_SESSION['user_id'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php"> Déconnexion</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php"> Connexion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php"> Inscription</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>