<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

require '../config.php';

// Suppression d’un message si demandé
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt = $pdo->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->execute([$delete_id]);
}

// Récupération des messages restants
$stmt = $pdo->query("SELECT * FROM messages ORDER BY id DESC");
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000;
            color: #fff;
        }
        .message-box {
            background-color: #1a1a1a;
            border: 1px solid #444;
        }
        .btn-warning {
            background-color: #f0ad4e;
            border: none;
        }
        .btn-warning:hover {
            background-color: #ec971f;
        }
        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">📥 Messages reçus</h2>

    <div class="mt-4">
        <?php if (count($messages) > 0): ?>
            <?php foreach ($messages as $msg): ?>
                <div class="mb-4 p-3 rounded message-box">
                    <div class="message-header">
                        <h5 class="mb-1"><?= htmlspecialchars($msg['name']) ?> (<?= htmlspecialchars($msg['email']) ?>)</h5>
                        <form method="post" onsubmit="return confirm('Supprimer ce message ?');">
                            <input type="hidden" name="delete_id" value="<?= $msg['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">🗑 Supprimer</button>
                        </form>
                    </div>
                    <p class="mt-2"><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Aucun message pour le moment.</p>
        <?php endif; ?>
    </div>

    <a href="../welcome.php" class="btn btn-warning">⬅ Retour</a>
</div>
</body>
</html>