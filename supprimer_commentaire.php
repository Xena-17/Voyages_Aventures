<?php
require 'bdd.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM Comments WHERE id = ?");
$stmt->execute([$id]);
$comment = $stmt->fetch();

if ($_SESSION['user_id'] != $comment['user_id'] && !$_SESSION['is_admin']) {
    header('Location: index.php');
    exit();
}

$stmt = $conn->prepare("DELETE FROM Comments WHERE id = ?");
$stmt->execute([$id]);

header('Location: article.php?id=' . $comment['article_id']);
?>
