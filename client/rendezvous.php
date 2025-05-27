<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client') {
    header("Location: ../login.php");
    exit;
}
require '../config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $date_rdv = $_POST['date_rdv'];
    $heure_rdv = $_POST['heure_rdv'];
    $prestation = htmlspecialchars($_POST['prestation']);
    if ($date_rdv && $heure_rdv && $prestation) {
        $stmt = $pdo->prepare("INSERT INTO rendezvous (user_id, date_rdv, heure_rdv, prestation) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $date_rdv, $heure_rdv, $prestation]);
        $message = "Rendez-vous enregistré !";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Prendre un rendez-vous</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: white;
    }
    .form-box {
      background-color: #1f1f1f;
      padding: 30px;
      border-radius: 10px;
      max-width: 500px;
      margin: auto;
      margin-top: 80px;
    }
  </style>
</head>
<body>
  <div class="form-box">
    <h2 class="text-center">Prendre un rendez-vous</h2>
    <?php if (isset($message)) echo "<p class='text-success'>$message</p>"; ?>
    <form method="POST">
      <label>Date :</label>
      <input type="date" name="date_rdv" class="form-control mb-3" required>
      <label>Heure :</label>
      <input type="time" name="heure_rdv" class="form-control mb-3" required>
      <label>Prestation :</label>
      <select name="prestation" class="form-control mb-4" required>
        <option value="">-- Choisir --</option>
        <option value="Coupe">Coupe</option>
        <option value="Barbe">Barbe</option>
        <option value="Coloration">Coloration</option>
      </select>
      <button type="submit" class="btn btn-success w-100">Valider le rendez-vous</button>
    </form>
  </div>
</body>
</html>