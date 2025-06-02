<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM rendezvous WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: admin/admin_rendezvous.php");
exit();
?>