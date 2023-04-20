<?php
    $dsn = "mysql: host=localhost; port=3306; dbname=blogopen; charset=utf8";
    $db = new PDO($dsn, "root", "");
    $sql = "SELECT * FROM article ORDER BY id_article DESC;";

    try {
        $query = $db-> prepare($sql);
        $query-> execute();
        if ($query->rowCount() == 1) {
            $result = $query->fetch();
            $titre = $result['titre'];
            $contenu = $result['contenu'];
        }
    } catch (PDOException|Exception|Error $e) {
        $e->getMessage();
}

    require "core/header.php";
?>
<main>
    <div class="titre_article">
    </div>
    <article class="art">
        <div class="titre">
            <h1><?= $titre ?></h1>
        </div>
        <p><?= $contenu ?></p>
    </article>
    <textarea name="commentaire" id="com" cols="186"></textarea>
</main>
<?php
    require "core/footer.php";
?>