<?php
session_start();
require 'config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $pdo->prepare("DELETE FROM rendezvous WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: admin_rendezvous.php");
exit;
?>