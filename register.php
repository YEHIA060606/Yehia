<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    if ($name && $email && $password) {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $password]);
        echo "Inscription réussie ! <a href='login.php'>Se connecter</a>";
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #1e1e1e;
      color: white;
    }
    .form-box {
      background-color: #2c2c2c;
      padding: 30px;
      border-radius: 10px;
      max-width: 400px;
      margin: auto;
      margin-top: 100px;
    }
  </style>
</head>
<body>
  <div class="form-box">
    <h2 class="text-center mb-4">Inscription</h2>
    <form method="POST">
      <input type="text" name="name" class="form-control mb-3" placeholder="Nom" required>
      <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
      <input type="password" name="password" class="form-control mb-3" placeholder="Mot de passe" required>
      <button type="submit" class="btn btn-warning w-100">S'inscrire</button>
    </form>
  </div>
</body>
</html>