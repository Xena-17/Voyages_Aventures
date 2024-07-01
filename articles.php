<?php
require 'bdd.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM Articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

$stmt = $conn->prepare("SELECT * FROM Comments WHERE article_id = ? ORDER BY created_at DESC");
$stmt->execute([$id]);
$comments = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $article['title']; ?></title>
</head>
<body>
    <h1><?php echo $article['title']; ?></h1>
    <p><?php echo $article['content']; ?></p>
    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $article['user_id']): ?>
        <a href="modifier_article.php?id=<?php echo $article['id']; ?>">Modifier</a>
        <a href="supprimer_article.php?id=<?php echo $article['id']; ?>">Supprimer</a>
    <?php endif; ?>
    <h2>Comments</h2>
    <?php foreach ($comments as $comment): ?>
        <p><?php echo $comment['content']; ?></p>
        <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $comment['user_id'] || $_SESSION['is_admin'])): ?>
            <a href="supprimer_commentaire.php?id=<?php echo $comment['id']; ?>">Supprimer</a>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if (isset($_SESSION['user_id'])): ?>
        <form action="ajouter_commentaire.php" method="POST">
            <textarea name="content" placeholder="Ajouter un commentaire" required></textarea>
            <input type="hidden" name="article_id" value="<?php echo $article['id']; ?>">
            <button type="submit">commentaire</button>
        </form>
    <?php endif; ?>
</body>
</html>
