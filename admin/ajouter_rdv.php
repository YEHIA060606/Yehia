<?php
session_start();
require '../config.php';

// Vérifier que l'utilisateur est admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $prestation = $_POST['prestation'];
    $user_id = $_POST['user_id']; // Peut être vide ou spécifique

    $stmt = $pdo->prepare("INSERT INTO rendezvous (user_id, date_rdv, heure_rdv, prestation) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $date, $heure, $prestation]);
    header("Location: admin_rendezvous.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Ajouter un rendez-vous</h2>
    <form method="post">
        <div class="mb-3">
            <label>Date :</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Heure :</label>
            <input type="time" name="heure" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Prestation :</label>
            <input type="text" name="prestation" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>ID Utilisateur (optionnel) :</label>
            <input type="number" name="user_id" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="admin_rendezvous.php" class="btn btn-secondary">Retour</a>
    </form>
</body>
</html>