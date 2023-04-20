<?php
// Configuration du DATA SOURCE NAME
    $dsn = "mysql: host=localhost; port=3306; dbname=blogopen; charset=utf8";
    // Connexion a la BDD
    $db = new PDO($dsn, "root", "");
    $db_resume = new PDO($dsn, "root", "");
    
    // Requete SQL
    $sql = ("SELECT * FROM article ORDER BY id_article DESC; LIMIT 10");
    $sql_resume = ("SELECT * FROM article ORDER BY id_article DESC; LIMIT 10");
    // Préparation a la requete SQL pour limiter les injectin SQL
    $query = $db-> prepare($sql);
    $query_resume = $db_resume-> prepare($sql_resume);

    // Appelation de fichier header.php
    require "core/header.php";
?>
<main>
    <div class="recherche">
        <input type="search" placeholder="Rechercher des articles" name="search">
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>
    <article>
        <div class="titre">
            <ul>
                <?php 
                // Execution de la requete
                if ($query-> execute()) {
                    // Quand la variable $a prend les résultat de la requete $query
                    while ($a = $query->fetch()) { ?>
                        <li><a href="article.php">
                            <?= // Tu affiche la ligne titre de la table article qui a était appellé par la requete sql
                            $a['titre']; ?></a></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <section class="section">
                <?php // Execution de la requete_resume
                if ($query_resume-> execute()) {
                        // Quand la variable $b prend les résultat de la requete $query_resume
                        while ($b = $query_resume->fetch()) { ?>
                            <li><?= // Tu affiche la ligne resume de la table article qui a était appellé par la requete sql_resume
                            $b['resume'] ?></li>
                    <?php } ?>
                <?php } ?>
        </section>
    </article>
</main>
<?php
    require "core/footer.php";
?>