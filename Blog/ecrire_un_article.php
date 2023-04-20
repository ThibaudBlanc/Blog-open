<?php
require "classe.php";
    if (
        isset($_POST["titre"]) && $_POST["titre"] !="" &&
        isset($_POST["contenu"]) && $_POST["contenu"] !="" &&
        isset($_POST["resume"]) && $_POST["resume"] !="" &&
        isset($_FILES["file"]) && $_FILES["file"] !="" ) {

        if (!empty($_POST) || !empty($_FILES)) {
                $temporary_name = $_FILES["file"]["tmp_name"];
                $upload_dir = "uploads/";
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir);
                }
                if (is_uploaded_file($temporary_name)) {
                    if ($_FILES["file"]["size"] < 1000000) {
                        $mime_type = mime_content_type($temporary_name);
                        $allowed_file_extension = ["image/jpg", "image/jpeg", "image/png"];
                        if (in_array($mime_type, $allowed_file_extension)) {
                            $targetFile = $upload_dir . basename($_FILES["file"]["name"]);
                            move_uploaded_file($temporary_name, $targetFile);

                            $message = new Message();
                            $message-> titre = $_POST["titre"];
                            $message-> contenu = $_POST["contenu"];
                            $message-> resume = $_POST["resume"];
                            $message-> image = $targetFile;

                            $message-> save();
                            header("location: http://workspace.me/Blog%20open/index.php");
                        } else {
                            echo "Pas le bon type de contenu et/ou pas la bonne extension de fichier";
                        }
                    } else {
                        echo "La taille du fichier est trop grande";
                    }
                } else {
                    echo "Le fichier n'a pas était téléchargé";
                }
        } else {
            echo "l'un des deux formulaire n'a pas était pas rempli";
        }
    }
require "core/header.php";
?>
<main>
    <div class="article_ecrire">
        <form action="" method="post" enctype="multipart/form-data">
            <ul>
                <div class="titre_de_larticle">
                    <input type="text" name="titre" placeholder="Donner un titre à votre article">
                </div>
                <div class="image">
                    <input type="file" name="file" accept="image/jpeg, image/png">
                </div>
                <div class="paragraphe">
                    <input type="text" name="contenu" placeholder="Description de l'article">
                </div>
                <div class="resume">
                    <input type="text" name="resume" placeholder="Résumé votre article">
                </div>
                <div class="btn">
                    <input type="submit" value="Validez votre article"></input>
                </div>
            </ul>
        </form>
    </div>
</main>
<?php
    require "core/footer.php";
?>