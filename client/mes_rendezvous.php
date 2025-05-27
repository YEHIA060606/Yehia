<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client') {
    header("Location: ../login.php");
    exit;
}
require '../config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
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
  </style>
</head>
<body>
  <h2 class="text-center mb-4">Mes Rendez-vous</h2>
  <div class="container">
    <?php if (count($rendezvous) === 0): ?>
      <p class="text-center">Aucun rendez-vous pour l'instant.</p>
    <?php else: ?>
      <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th>Date</th>
            <th>Heure</th>
            <th>Prestation</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rendezvous as $rdv): ?>
            <tr>
              <td><?= $rdv['date_rdv'] ?></td>
              <td><?= $rdv['heure_rdv'] ?></td>
              <td><?= htmlspecialchars($rdv['prestation']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</body>
</html>