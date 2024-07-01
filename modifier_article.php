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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];
    $category_id = $_POST['category_id'];

    $stmt = $conn->prepare("UPDATE Articles SET title = ?, content = ?, image = ?, category_id = ? WHERE id = ?");
    $stmt->execute([$title, $content, $image, $category_id, $id]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un article</title>
</head>
<body>
    <form action="edit_article.php?id=<?php echo $id; ?>" method="POST">
        <input type="text" name="title" value="<?php echo $article['title']; ?>" required>
        <textarea name="content" required><?php echo $article['content']; ?></textarea>
        <input type="text" name="image" value="<?php echo $article['image']; ?>">
        <select name="category_id">
            <?php
            $stmt = $conn->query("SELECT * FROM Categories");
            while ($row = $stmt->fetch()) {
                $selected = $row['id'] == $article['category_id'] ? 'selected' : '';
                echo "<option value='{$row['id']}' {$selected}>{$row['name']}</option>";
            }
            ?>
        </select>
        <button type="submit">Modifier article</button>
    </form>
</body>
</html>
