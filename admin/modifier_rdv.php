<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: admin_rendezvous.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM rendezvous WHERE id = ?");
$stmt->execute([$id]);
$rdv = $stmt->fetch();

if (!$rdv) {
    header("Location: admin_rendezvous.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date_rdv'];
    $heure = $_POST['heure_rdv'];
    $prestation = $_POST['prestation'];

    $update = $pdo->prepare("UPDATE rendezvous SET date_rdv = ?, heure_rdv = ?, prestation = ? WHERE id = ?");
    $update->execute([$date, $heure, $prestation, $id]);

    header("Location: admin_rendezvous.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="mb-4">Modifier le Rendez-vous (Admin)</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Date :</label>
            <input type="date" name="date_rdv" class="form-control" value="<?= $rdv['date_rdv'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Heure :</label>
            <input type="time" name="heure_rdv" class="form-control" value="<?= $rdv['heure_rdv'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Prestation :</label>
            <select name="prestation" class="form-select" required>
                <option value="Coupe" <?= $rdv['prestation'] == 'Coupe' ? 'selected' : '' ?>>Coupe</option>
                <option value="Barbe" <?= $rdv['prestation'] == 'Barbe' ? 'selected' : '' ?>>Barbe</option>
                <option value="Coloration" <?= $rdv['prestation'] == 'Coloration' ? 'selected' : '' ?>>Coloration</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">Valider les modifications</button>
        <a href="admin_rendezvous.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</body>
</html>