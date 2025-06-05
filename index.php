<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Salon Yehia - Accueil</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .navbar {
      background-color: #000;
    }
    .navbar a {
      color: white !important;
    }
    .hero {
      background: url('assets/background.png') no-repeat center center;
      background-size: cover;
      height: 400px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      text-shadow: 1px 1px 3px black;
    }
    .prestation-card {
      border: none;
      border-radius: 10px;
      overflow: hidden;
    }
    .prestation-card img {
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="index.php"><i class="fas fa-cut"></i> Yehia Salon</a>
  </div>
</nav>

<header class="hero text-center">
  <h1>Bienvenue chez le Salon Yehia</h1>
</header>

<section class="container mt-5">
  <h2 class="text-center mb-4">Nos Prestations</h2>
  <div class="row text-center">
    <div class="col-md-4 mb-4">
      <div class="card prestation-card">
        <img src="assets/coupe.jpg" class="card-img-top" alt="Coupe">
        <div class="card-body">
          <h5 class="card-title">Coupe</h5>
          <p class="card-text">15€ - Coupe homme tendance</p>
        </div>
            <a class="btn btn-primary" href="<?php 
        echo isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'client' 
            ? 'client/rendezvous.php' 
            : 'login.php'; 
    ?>">Réserver</a>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card prestation-card">
        <img src="assets/barbe.jpg" class="card-img-top" alt="Barbe">
        <div class="card-body">
          <h5 class="card-title">Barbe</h5>
          <p class="card-text">10€ - Taille et soin barbe</p>
        </div>
            <a class="btn btn-primary" href="<?php 
        echo isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'client' 
            ? 'client/rendezvous.php' 
            : 'login.php'; 
    ?>">Réserver</a>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card prestation-card">
        <img src="assets/coloration.jpg" class="card-img-top" alt="Coloration">
        <div class="card-body">
          <h5 class="card-title">Coloration</h5>
          <p class="card-text">25€ - Coloration complète</p>
  </div>
    <a class="btn btn-primary" href="<?php 
        echo isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'client' 
            ? 'client/rendezvous.php' 
            : 'login.php'; 
    ?>">Réserver</a>
</div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>