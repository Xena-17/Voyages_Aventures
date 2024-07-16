 <?php
    session_start();
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
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
    <form method="post" action="connexion.php">
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
    // Vérification des champs email et password
    
    if(isset($_POST["email"], $_POST["password"])){
       include"bdd.php";
        $sql_select_utilisateur = "SELECT * FROM Users WHERE email lIKE :email AND password LIKE :password;";
        $requete_select_utilisateur = $conn->prepare($sql_select_utilisateur);
        $requete_select_utilisateur->execute(
            array(
                ":email" => $_POST["email"],
                ":password" => $_POST["password"]
            )
        );
        $resultat = $requete_select_utilisateur->fetch();
         var_dump($_POST["email"], $_POST["password"],$resultat);
    }
    var_dump($resultat);
        if($resultat["email"]=$_POST["email"]){
            $_SESSION["username"] = $resultat["username"];
            $_SESSION["password"] = $resultat["password"];

            header("Location:ajout_article.php");
        } else {
            echo "Email ou mot de passe incorrect";
                }
    

?>