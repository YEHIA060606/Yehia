<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST['message']);
    if ($name && $email && $message) {
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $message]);
        $confirmation = "Message envoyé avec succès !";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Contact</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #101010;
      color: white;
    }
    .form-box {
      background-color: #2b2b2b;
      padding: 30px;
      border-radius: 10px;
      max-width: 500px;
      margin: auto;
      margin-top: 80px;
    }
  </style>
</head>
<body>
  <div class="form-box">
    <h2 class="text-center mb-4">Contactez-nous</h2>
    <?php if (isset($confirmation)) echo "<p class='text-success'>$confirmation</p>"; ?>
    <form method="POST">
      <input type="text" name="name" class="form-control mb-3" placeholder="Nom" required>
      <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
      <textarea name="message" rows="4" class="form-control mb-3" placeholder="Message..." required></textarea>
      <button type="submit" class="btn btn-primary w-100">Envoyer</button>
    </form>
  </div>
</body>
</html>