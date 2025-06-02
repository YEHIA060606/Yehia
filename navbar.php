<?php
session_start();
?>

<nav style="background-color:#333;padding:10px;">
    <a href="index.php" style="color:white;text-decoration:none;margin-right:20px;">🏠 Accueil</a>

    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="client/mes_rendezvous.php" style="color:white;text-decoration:none;margin-right:20px;">📅 Mes RDV</a>
        <a href="logout.php" style="color:white;text-decoration:none;">🚪 Déconnexion</a>
    <?php else: ?>
        <a href="login.php" style="color:white;text-decoration:none;margin-right:20px;">🔐 Connexion</a>
        <a href="register.php" style="color:white;text-decoration:none;">📝 Inscription</a>
    <?php endif; ?>
</nav>