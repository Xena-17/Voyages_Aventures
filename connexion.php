 <?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <a href=deconnexion.php>se déconnecter</a><br>
    <form method="post" action="">
        <label for="email">Email</label>
        <input type="email" name="email" id="email"><br>
        
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password"><br>

        <input type="submit" value="Envoyer">
    </form>

    <a href="./inscription.php">S'inscrire</a><br>
</body>
</html>

<?php
    if(isset($_POST["email"], $_POST["password"])){
        require_once "bdd.php";
        $sql_select_utilisateur = "SELECT * FROM Users WHERE email lIKE :email AND password LIKE :password;";
        $requete_select_utilisateur = $conn->prepare($sql_select_utilisateur);
        $requete_select_utilisateur->execute(
            array(
                ":email" => $_POST["email"],
                ":password" => $_POST["password"]
            )
        );
        $resultat = $requete_select_utilisateur->fetch();

        if($resultat != false){
            $_SESSION["username"] = $resultat["username"];
            $_SESSION["password"] = $resultat["password"];

            header("Location:ajout_article.php");
        }
    }
?>