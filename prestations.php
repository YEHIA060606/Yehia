<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Nos Prestations</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #181818;
      color: white;
      font-family: Arial, sans-serif;
    }
    .card {
      background-color: #262626;
      height: 100%;
    }
    .card-img-top{
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>
<a href="/Yehia/welcome.php" style="position: fixed; top: 10px; left: 10px; background-color: #444; color: white; padding: 10px; border-radius: 5px; text-decoration: none;">
    ⬅ Retour à l'accueil
</a>
<body class="p-4">
  <div class="container">
    <h1 class="mb-4 text-center">Nos Prestations</h1>
    <div class="row">
      <div class="col-md-4">
        <div class="card text-white mb-3">
          <img src="assets/coupe.jpg" class="card-img-top" alt="Coupe">
          <div class="card-body">
            <h5 class="card-title">Coupe classique</h5>
            <p class="card-text">Prix : 15€</p>
            <a href="client/rendezvous.php" class="btn btn-warning">Réserver</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-white mb-3">
          <img src="assets/barbe.jpg" class="card-img-top" alt="Barbe">
          <div class="card-body">
            <h5 class="card-title">Taille de barbe</h5>
            <p class="card-text">Prix : 10€</p>
            <a href="client/rendezvous.php" class="btn btn-warning">Réserver</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-white mb-3">
          <img src="assets/coloration.jpg" class="card-img-top" alt="Soin">
          <div class="card-body">
            <h5 class="card-title">Coloration</h5>
            <p class="card-text">Prix : 20€</p>
            <a href="client/rendezvous.php" class="btn btn-warning">Réserver</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
