<?php
session_start();

// Vérifie que l'utilisateur est connecté ET est admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

require '../config.php'; // PAS admin_rendezvous.php !

// Vérifie qu'un ID est bien passé en GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Supprimer le rendez-vous avec l'ID donné
    $stmt = $pdo->prepare("DELETE FROM rendezvous WHERE id = ?");
    $stmt->execute([$id]);
}

// Redirige vers la liste après suppression
header("Location: admin_rendezvous.php");
exit;
