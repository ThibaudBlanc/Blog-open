<?php
session_start();
    if (isset($_POST["pseudo"]) && $_POST["pseudo"] !="" &&
    isset($_POST["mdp"]) && $_POST["mdp"] !=""
    ) {
        $pseudo = $_POST["pseudo"];
        $mdp = $_POST["mdp"];

        try {
        require "core/config.php";

        $sql = "SELECT * FROM utilisateurs;";

        $db = new PDO($dsn, $dbuser, $dbpassword);

        $query = $db-> prepare($sql);

        $query-> execute();

        $resultat = $query-> fetchAll();

        foreach ($resultat as $row) {
            // var_dump($row);
            $_SESSION["utilisateur"] = $row["id_utilisateur"];
            password_verify($_POST["mdp"], $row["mdp"]);
        }
        if (password_verify($_POST["mdp"], $row["mdp"])) {
            header("location: http://workspace.me/Blog%20open/index.php");
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
        $message = "c'est pas bon";
    }
} else {
        $erreur = "rien n'est bon";
}
    require "core/header.php";
?>
<main>
    <div class="titre_connexion">
        <h1>Connexion :</h1>
    </div>
    <form action="" method="post" class="form_coco">
        <input type="text" placeholder="pseudo" name="pseudo">
        <input type="password" placeholder="mot de passe" name="mdp">
        <a href="">Mot de passe oublié ?</a>
        <button type="submit" class="valid">Validez</button>
    </form>
</main>
<?php
    require "core/footer.php";
?>