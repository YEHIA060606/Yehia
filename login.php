<?php
session_start();
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'] ?? 'client';
        header("Location: welcome.php");
        exit;
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .form-box {
      background-color: #1f1f1f;
      padding: 30px;
      border-radius: 10px;
      width: 100%;
      max-width: 400px;
    }
    a {
      color: #ffc107;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<a href="/Yehia/index.php" style="position: fixed; top: 10px; left: 10px; background-color: #444; color: white; padding: 10px; border-radius: 5px; text-decoration: none;">
    ⬅ Retour à l'accueil
</a>

<div class="form-box">
  <h2 class="text-center mb-4">Connexion</h2>
  <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
  <form method="POST">
    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-2" placeholder="Mot de passe" required>
    <div class="mb-3 text-end">
      <a href="#">Mot de passe oublié ?</a>
    </div>
    <button type="submit" class="btn btn-primary w-100 mb-3">Se connecter</button>
    <p class="text-center">Vous n'avez pas de compte ? <a href="register.php">Créer un compte</a></p>
  </form>
</div>

</body>
</html>