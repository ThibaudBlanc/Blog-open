<?php
    class Message {
        private int $id;
        private string $titre;
        private string $contenu;
        private string $resume;
        private string $image;

    public function __construct() {
        $this-> id = 0;
        $this-> titre = "";
        $this-> contenu = "";
        $this-> resume = "";
        $this-> image = "";
    }

    public function __set($property, $value) {
        $this-> $property = $value;
    }

    public function __get($property) {
        return $this-> $property;
    }

    public function save(): bool {
        $dsn = "mysql: host=localhost; port=3306; dbname=blogopen; charset=utf8";
        $sql = "INSERT INTO article (titre, contenu, resume, image) VALUES (:titre, :contenu, :resume, :image);";
        try {
            $db = new PDO($dsn, "root", "");

            $query = $db->prepare($sql);

            $query-> bindParam("titre", $this-> titre, PDO::PARAM_STR);
            $query-> bindParam("contenu", $this-> contenu, PDO::PARAM_STR);
            $query-> bindParam("resume", $this-> resume, PDO::PARAM_STR);
            $query-> bindParam("image", $this-> image, PDO::PARAM_STR);

            if ($query-> execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException|Exception|Error $e) {
            return false;
        }
    }
}