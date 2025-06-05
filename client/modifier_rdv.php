<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: mes_rendezvous.php");
    exit;
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Récupérer les infos du rendez-vous
$stmt = $pdo->prepare("SELECT * FROM rendezvous WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $user_id]);
$rdv = $stmt->fetch();

if (!$rdv) {
    echo "Rendez-vous introuvable.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $prestation = $_POST['prestation'];

    $update = $pdo->prepare("UPDATE rendezvous SET date_rdv = ?, heure_rdv = ?, prestation = ? WHERE id = ? AND user_id = ?");
    $update->execute([$date, $heure, $prestation, $id, $user_id]);

    header("Location: mes_rendezvous.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<a href="/Yehia/client/mes_rendezvous.php" style="position: fixed; top: 10px; left: 10px; background-color: #444; color: white; padding: 10px; border-radius: 5px; text-decoration: none;">
    ⬅ Retour à l'accueil
</a>
<body class="bg-dark text-white p-4">
<div class="container">
    <h2 class="text-center mb-4">Modifier le Rendez-vous</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="<?= $rdv['date_rdv'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Heure</label>
            <input type="time" name="heure" class="form-control" value="<?= $rdv['heure_rdv'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Prestation</label>
            <select name="prestation" class="form-control" required>
                <option value="Coupe" <?= $rdv['prestation'] == 'Coupe' ? 'selected' : '' ?>>Coupe</option>
                <option value="Barbe" <?= $rdv['prestation'] == 'Barbe' ? 'selected' : '' ?>>Barbe</option>
                <option value="Coloration" <?= $rdv['prestation'] == 'Coloration' ? 'selected' : '' ?>>Coloration</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">Modifier</button>
        <a href="../supprimer_rdv.php?id=<?= $rdv['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce rendez-vous ?')">Supprimer</a>
    </form>
</div>
</body>
</html>