<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Bienvenue</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
  <style>
    body {
      background-color: #0d0d0d;
      color: white;
      text-align: center;
    }
    .btn {
      margin: 10px;
      width: 200px;
    }
  </style>
</head>
<body>
  <h1 class="mb-4">Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']); ?> !</h1>
  <div>
        <?php if ($_SESSION['user_role'] === 'client'): ?>
      <a href="client/rendezvous.php" class="btn btn-success m-2">Prendre un rendez-vous</a>
      <a href="client/mes_rendezvous.php" class="btn btn-outline-light m-2">Mes rendez-vous</a>
      <a href="prestations.php" class="btn btn-warning m-2">Nos prestations</a>
      <a href="contact.php" class="btn btn-outline-info">Contact</a><br>
    <?php elseif ($_SESSION['user_role'] === 'admin'): ?>
      <a href="admin/admin_rendezvous.php" class="btn btn-warning m-2">Gérer les RDV</a>
      <a href="admin/admin_messages.php" class="btn btn-info m-2">Voir les messages</a>
    <?php endif; ?>
    <a href="logout.php" class="btn btn-outline-danger">Se déconnecter</a>
  </div>
</body>
</html>