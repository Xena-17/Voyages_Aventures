<?php
require 'bdd.php';

$stmt = $conn->query("SELECT * FROM Articles ORDER BY created_at DESC");
$articles = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voyages & Aventures</title>
</head>
<body>
    <h1>Voyages & Aventures</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Bonjour, <?php echo $_SESSION['username']; ?>! <a href="deconnexion.php">Déconnexion</a></p>
        <a href="ajout_article.php">Ajout nouvel article</a>
        <a href="profil.php">Profil</a>
        <?php if ($_SESSION['is_admin']): ?>
            <a href="admin.php">Administration</a>
        <?php endif; ?>
    <?php else: ?>
        <a href="connexion.php">Connexion</a>
        <a href="inscription.php">Inscription</a>
    <?php endif; ?>
    <h2>Articles</h2>
    <?php foreach ($articles as $article): ?>
        <h3><?php echo $article['title']; ?></h3>
        <p><?php echo substr($article['content'], 0, 100); ?>...</p>
        <a href="article.php?id=<?php echo $article['id']; ?>">Lire plus</a>
    <?php endforeach; ?>
</body>
</html>
