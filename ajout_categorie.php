<?php
require 'bdd.php';
session_start();

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: connexion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    $stmt = $conn->prepare("INSERT INTO Categories (name) VALUES (?)");
    $stmt->execute([$name]);

    header('Location: admin.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Catégorie</title>
</head>
<body>
    <form action="ajout.categorie.php" method="POST">
        <input type="text" name="name" placeholder="Nom de la Catégorie" required>
        <button type="submit">Ajout Catégorie</button>
    </form>
</body>
</html>
