<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
require '../config.php';

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();

$stmt2 = $pdo->query("SELECT * FROM rendezvous");
$rendezvous = $stmt2->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Tableau de bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white p-4">
    <h1 class="mb-4">Tableau de bord Admin</h1>

    <h2>Utilisateurs</h2>
    <table class="table table-bordered table-striped text-white">
        <thead><tr><th>ID</th><th>Email</th><th>Rôle</th></tr></thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['role'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Rendez-vous</h2>
    <table class="table table-bordered table-striped text-white">
        <thead><tr><th>ID</th><th>Utilisateur</th><th>Date</th><th>Heure</th><th>Prestation</th></tr></thead>
        <tbody>
        <?php foreach ($rendezvous as $rdv): ?>
            <tr>
                <td><?= $rdv['id'] ?></td>
                <td><?= $rdv['user_id'] ?></td>
                <td><?= $rdv['date_rdv'] ?></td>
                <td><?= $rdv['heure_rdv'] ?></td>
                <td><?= $rdv['prestation'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>