<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client') {
    header("Location: ../login.php");
    exit;
}
require '../config.php';

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT id, date_rdv, heure_rdv, prestation FROM rendezvous WHERE user_id = ? ORDER BY date_rdv");
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
    .btn-sm {
      margin: 0 5px;
    }
  </style>
</head>
<body>
  <h2 class="text-center mb-4">Mes Rendez-vous</h2>
  <div class="container">
    <?php if (count($rendezvous) === 0): ?>
      <p class="text-center">Aucun rendez-vous pour l'instant.</p>
    <?php else: ?>
      <table class="table table-dark table-striped text-center">
        <thead>
          <tr>
            <th>Date</th>
            <th>Heure</th>
            <th>Prestation</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rendezvous as $rdv): ?>
            <tr>
              <td><?= htmlspecialchars($rdv['date_rdv']) ?></td>
              <td><?= htmlspecialchars($rdv['heure_rdv']) ?></td>
              <td><?= htmlspecialchars($rdv['prestation']) ?></td>
              <td>
                <a href="modifier_rdv.php?id=<?= $rdv['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                <a href="../supprimer_rdv.php?id=<?= $rdv['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="../welcome.php" class="btn btn-outline-light">Retour à l'accueil</a>
    </div>
  </div>
</body>
</html>