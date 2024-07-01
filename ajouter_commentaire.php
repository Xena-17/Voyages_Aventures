<?php
require 'bdd.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $article_id = $_POST['article_id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO Comments (content, user_id, article_id) VALUES (?, ?, ?)");
    $stmt->execute([$content, $user_id, $article_id]);

    header('Location: article.php?id=' . $article_id);
}
?>
