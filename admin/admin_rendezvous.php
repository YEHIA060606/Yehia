<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

require '../config.php';

$stmt = $pdo->query("SELECT r.id, r.date_rdv, r.heure_rdv, r.prestation, u.name 
                     FROM rendezvous r 
                     JOIN users u ON r.user_id = u.id 
                     ORDER BY r.date_rdv, r.heure_rdv");
$rendezvous = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            color: #fff;
        }
        .btn-outline-light {
            font-size: 0.9rem;
            padding: 0.25rem 0.5rem;
        }
        h2 {
            font-weight: 600;
            font-size: 1.5rem;
        }
    </style>
</head>
<body class="p-4">

    <!-- Header avec bouton retour + titre -->
    <div class="d-flex align-items-center justify-content-start mb-4 gap-3">
        <a href="../welcome.php" class="btn btn-sm btn-outline-light">⬅ Retour</a>
        <h2 class="mb-0">Liste des Rendez-vous</h2>
    </div>

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
                        <a href="modifier_rdv.php?id=<?= $rdv['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="supprimer_rdv.php?id=<?= $rdv['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce rendez-vous ?')">Supprimer</a>
                        <a href="ajouter_rdv.php" class="btn btn-sm btn-success">Ajouter</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

