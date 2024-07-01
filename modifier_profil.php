<?php
require 'bdd.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
    $user_id = $_SESSION['user_id'];

    if ($password) {
        $stmt = $conn->prepare("UPDATE Users SET username = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$username, $email, $password, $user_id]);
    } else {
        $stmt = $conn->prepare("UPDATE Users SET username = ?, email = ? WHERE id = ?");
        $stmt->execute([$username, $email, $user_id]);
    }

    header('Location: profil.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Profil</title>
</head>
<body>
    <form action="modifier_profil.php" method="POST">
        <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" required>
        <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" required>
        <input type="password" name="password" placeholder="Nouveau mot de passe">
        <button type="submit">Modifier Profil</button>
    </form>
</body>
</html>
