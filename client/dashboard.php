<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client') {
    header("Location: ../login.php");
    exit;
}
require '../config.php';
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT date_rdv, heure_rdv, prestation FROM rendezvous WHERE user_id = ? ORDER BY date_rdv");
$stmt->execute([$user_id]);
$rendezvous = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes Rendez-vous</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: white;
      padding: 30px;
    }
    .card {
      background-color: #1f1f1f;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <h1>Mes Rendez-vous</h1>
  <?php if (count($rendezvous) === 0): ?>
    <p>Vous n'avez aucun rendez-vous pour le moment.</p>
  <?php else: ?>
    <div class="row">
      <?php foreach ($rendezvous as $rdv): ?>
        <div class="col-md-4">
          <div class="card p-3">
            <h5><?= htmlspecialchars($rdv['prestation']) ?></h5>
            <p>Date : <?= $rdv['date_rdv'] ?></p>
            <p>Heure : <?= $rdv['heure_rdv'] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</body>
</html>