<!DOCTYPE html>
<head>
    <title>Inscription</title>
</head>
<body>
    <h1>Formulaire d'inscription</h1>
    <form method="POST" action="">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" required><br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required><br>

        <input type="submit" value="Envoyer">
    </form>
    <a href="./connexion.php">Connexion</a>
</body>

<?php
    if(isset($_POST["username"], $_POST["email"], $_POST["password"])){
        include "bdd.php";
        $sql_insert_utilisateur = "INSERT INTO Users(username, email, password) VALUES (:username, :email, :password);";
        $requete_insert_utilisateur = $conn->prepare($sql_insert_utilisateur);
        $requete_insert_utilisateur->execute(
            array(
                ":username" => $_POST['username'],
                ":email" => $_POST['email'],
                ":password" => $_POST['password']
            )
        );
    }
?>