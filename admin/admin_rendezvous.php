<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
require '../config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
$stmt = $pdo->query("SELECT r.id, r.date_rdv, r.heure_rdv, r.prestation, u.name FROM rendezvous r JOIN users u ON r.user_id = u.id ORDER BY r.date_rdv, r.heure_rdv");
$rendezvous = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Rendez-vous</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white p-4">
  <h2 class="text-center mb-4">Liste des Rendez-vous</h2>
  <div class="container">
    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Date</th>
          <th>Heure</th>
          <th>Prestation</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rendezvous as $rdv): ?>
        <tr>
          <td><?= htmlspecialchars($rdv['name']) ?></td>
          <td><?= $rdv['date_rdv'] ?></td>
          <td><?= $rdv['heure_rdv'] ?></td>
          <td><?= $rdv['prestation'] ?></td>
          <td>
            <a href="supprimer_rdv.php?id=<?= $rdv['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce rendez-vous ?')">Supprimer</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <a href="../welcome.php" class="btn btn-light mt-3">Retour</a>
  </div>
</body>
</html>