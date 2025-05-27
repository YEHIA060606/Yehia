<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
require '../config.php';

$stmt = $pdo->query("SELECT * FROM messages ORDER BY id DESC");
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="text-center">Messages reçus</h2>
    <div class="mt-4">
        <?php foreach ($messages as $msg): ?>
            <div class="mb-4 p-3 border rounded bg-dark text-white">
                <h5><?= htmlspecialchars($msg['name']) ?> (<?= htmlspecialchars($msg['email']) ?>)</h5>
                <p><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="../welcome.php" class="btn btn-warning">Retour</a>
</div>
</body>
</html>