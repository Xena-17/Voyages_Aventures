<?php
require 'bdd.php';

$category_id = $_GET['category_id'];
$stmt = $conn->prepare("SELECT * FROM Articles WHERE category_id = ?");
$stmt->execute([$category_id]);
$articles = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Articles par Catégories</title>
</head>
<body>
    <h1>Articles</h1>
    <?php foreach ($articles as $article): ?>
        <h2><?php echo $article['title']; ?></h2>
        <p><?php echo $article['content']; ?></p>
        <a href="article.php?id=<?php echo $article['id']; ?>">Lire plus</a>
    <?php endforeach; ?>
</body>
</html>
