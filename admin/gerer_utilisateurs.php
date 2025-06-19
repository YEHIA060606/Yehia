<?php
session_start();
require '../config.php';

// Vérifie que l'utilisateur est bien un admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Promotion ou retrait de rôle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['new_role'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['new_role'];

    // Ne pas permettre à un admin de se retirer lui-même son rôle
    if ($user_id != $_SESSION['user_id']) {
        $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$new_role, $user_id]);
    }
}

// Récupération de tous les utilisateurs
$stmt = $pdo->query("SELECT id, email, role FROM users");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000;
            color: #fff;
        }
        .table {
            color: #fff;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #1a1a1a;
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: #2c2c2c;
        }
        .text-muted {
            color: #ccc !important;
        }
    </style>
</head>
<body class="container mt-5">
    <a href="../welcome.php" class="btn btn-secondary mb-4">⬅ Retour</a>
    <h2 class="mb-4">👥 Gérer les utilisateurs</h2>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                    <?php if ($user['role'] === 'admin'): ?>
                        <?php if ($user['id'] != $_SESSION['user_id']): ?>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <input type="hidden" name="new_role" value="client">
                                <button type="submit" class="btn btn-sm btn-danger">Retirer admin</button>
                            </form>
                        <?php else: ?>
                            <span class="text-muted">Vous</span>
                        <?php endif; ?>
                    <?php else: ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <input type="hidden" name="new_role" value="admin">
                            <button type="submit" class="btn btn-sm btn-warning">Promouvoir admin</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
