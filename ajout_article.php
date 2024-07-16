<?php
require 'bdd.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];
    $category_id = $_POST['category_id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO Articles (title, content, image, user_id, category_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $content, $image, $user_id, $category_id]);

    header('Location: index.php');
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un article</title>
</head>
<body>
    <form action="add_article.php" method="POST">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="content" placeholder="Content" required></textarea>
        <input type="text" name="image" placeholder="Image URL">
        <select name="category_id">
            <?php
            $stmt = $conn->query("SELECT * FROM Categories");
            while ($row = $stmt->fetch()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
            ?>
        </select>
        <button type="submit">Add Article</button>
    </form>
</body>
</html>
