<?php
require 'bdd.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM Articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

if ($_SESSION['user_id'] != $article['user_id']) {
    header('Location: index.php');
    exit();
}

$stmt = $conn->prepare("DELETE FROM Articles WHERE id = ?");
$stmt->execute([$id]);

header('Location: index.php');
?>
