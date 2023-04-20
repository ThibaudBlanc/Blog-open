<?php
// Détermine les variables pour voir si ils sont déclaré ou pas et différente de null
// var_dump($_POST);
    if (isset($_POST["email"]) && $_POST["email"] !="" &&
        isset($_POST["mdp"]) && $_POST["mdp"] !="" &&
        isset($_POST["password_confirmation"]) && $_POST["password_confirmation"] !="" &&
        isset($_POST["pseudo"]) && $_POST["pseudo"] !="" &&
        isset($_POST["ville"]) && $_POST["ville"] !=""
    ) {
        require "core/config.php";

        try {
            if ($_POST["mdp"] == $_POST["password_confirmation"]) {
            $email = $_POST["email"];

            $options = ["cost" => 12];
            $mdp = password_hash($_POST["mdp"], PASSWORD_BCRYPT, $options);

            $confirm_password = $_POST["password_confirmation"];
            $pseudo = $_POST["pseudo"];
            $ville = $_POST["ville"];
            $pays = isset($_POST["pays"]) ? $_POST["pays"] : "";
            
            $sql = "INSERT INTO utilisateurs (email, mdp, password_confirmation, pseudo, pays, ville) VALUES (:email, :mdp, :password_confirmation, :pseudo, :pays, :ville);";
            // var_dump($sql);
            
            $db = new PDO($dsn, $dbuser, $dbpassword);
            $db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $db-> prepare($sql);
            $query-> bindParam(":email", $email);
            $query-> bindParam(":mdp", $mdp);
            $query-> bindParam(":password_confirmation", $confirm_password);
            $query-> bindParam(":pseudo", $pseudo);
            $query-> bindParam(":pays", $pays);
            $query-> bindParam(":ville", $ville);
            // var_dump($query);

            $query-> execute();
            } else {
                $erreur = "les mot de passes ne se correspondent pas";
            }
    } catch(PDOException $e) {
        echo $e-> getMessage();
        $message = "c'est pas ouf";
    }
} else {
    $erreur = "les champs obligatoires ne sont complétés";
}

    $title = "Inscrivez-vous";
    require "core/header.php";
?>
<main>
    <div class="titre_inscription">
        <h1>Inscription :</h1>
    </div>
    <?php if(isset($erreur)) { ?>
        <p><?= $erreur;?></p>
    <?php }?>
    <form action="" method="post" class="form_coco">
        <input type="email" placeholder="Email" name="email" required>
        <input type="password" placeholder="Mot de passe" name="mdp" required>
        <input type="password" placeholder="Confirmation de mot de passe" name="password_confirmation" required>
        <input type="text" placeholder="pseudo" name="pseudo" required>
        <input type="text" name="ville" placeholder="Ville" required>
        <input type="text" name="pays" placeholder="Pays">
        <button class="valid">Connexion</button>
    </form>
</main>
<?php
    require "core/footer.php";
?>