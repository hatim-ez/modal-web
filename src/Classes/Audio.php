
<?php
require("player.php");

class Audio {

    public $id;
    public $titre;
    public $artiste;
    public $album;
    public $annee;
    public $genre;
    public $description;
    public $login; //le pseudo

    
    //Ajout d'un fichier audio dans la table 'audio'
    public static function insererAudio($dbh, $login, $titre, $artiste, $album, $annee, $genre, $description) {
        $sth = $dbh->prepare("INSERT INTO audio VALUES( NULL, ?, ?,?,?, ?, ?, ?)");
        $sth->execute(array($login, $titre, $artiste, $album, $annee, $genre, $description));
        return true;
    }

    //Vérifie si l'utilisateur $login a déjà posté un titre $titre
    public static function isAudioExisting($dbh, $login, $titre) {
        $query = "SELECT * FROM audio WHERE loginUser = ? AND titre=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'audios');
        $sth->execute(array($login, $titre));
        $song = $sth->fetch();
        $sth->closeCursor();
        if ($song == null) {
            return false;
        } else {
            return true;
        }
    }

    //Supprime la ligne correspondante de la table 'audio'
    public static function deleteAudio($dbh, $login, $titre) {
        //Il faudrait également supprimer le fichier mp3 du folder Audios, a faire avec la fonction unlink() mais problème avec le chemin du fichier
        // notamment pour remonter dans le dossier parent
        $sth = $dbh->prepare("DELETE FROM `audio` WHERE `login`=? AND `titre`=? ");
        $sth->execute(array($login, $titre));
        //unlink("../Audios/".$login.$titre.".mp3");
        //Supprimer la chanson de la base de donnée
        return true;
    }

    //Même fonction qu'au dessus mais avec l'id de l'audio plutôt que son titre et la personne qui l'a posté
    public static function deleteAudioById($dbh, $id) {
        //Il faudrait également supprimer le fichier mp3 du folder Audios, a faire avec la fonction unlink() mais problème avec le chemin du fichier
        // notamment pour remonter dans le dossier parent
        $sth = $dbh->prepare("Select * FROM `audio` WHERE `id` = ? ");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'audio');
        $sth->execute(array($id));
        $song = $sth->fetch();
        $loginUser = $song->loginUser;
        $titre = $song->titre;
        //unlink("../Audios/".$loginUser.$titre.".mp3");
        //Supprimer la chanson de la base de donnée
        $sth = $dbh->prepare("DELETE FROM `audio` WHERE `id`=?  ");
        $sth->execute(array($id));
        return true;
    }

    
    //Changer le genre d'une chanson
    public static function changeTagAudio($dbh, $login, $titre, $tag) {
        $sth = $dbh->prepare("UPDATE audio SET genre = ? WHERE 'loginUser'= ? AND'titre' = ? ");
        $sth->execute(array($genre, $login, $titre));
        return true;
    }

    //Même fonction qu'au dessus mais avec l'id de l'audio plutôt que son titre et la personne qui l'a posté
    public static function changeTagAudioById($dbh, $id, $tag) {
        $sth = $dbh->prepare("UPDATE audio SET genre = ? WHERE id= ?  ");
        $sth->execute(array($tag, $id));
        return true;
    }

    
    //Fonction qui permet d'afficher les $number dernières musiques ajoutées sur le site
    public static function afficherLastMusiques($dbh, $number) {
        $query = "SELECT * FROM `audio` ORDER BY id DESC LIMIT " . $number;
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute();
        $i = 1;
        //S'il n'y a pas de musique uploadé :
        if ($rows = $sth->rowCount() == 0)
            echo '<p style="font-size:25px; margin-left : 200px">Cette page manque de contenu .. On compte sur vous ! </p>';
        //Sinon
        else {
            while ($courant = $sth->fetch(PDO::FETCH_ASSOC)) {
                //Il faut faire attention au cas où le login ou le titre présente des espaces auquel cas on les remplace par des '_'
                $music = "Audios/" . str_replace(" ", "_", $courant['loginUser'] . $courant['titre']) . ".mp3";

                printPlayer($i, $courant, $dbh);
                $i = $i + 1;
            }
        }
        ?><script type="text/javascript">
            $(document).ready(function () {
        <?php
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute();
        $i = 1;

        while ($courant = $sth->fetch(PDO::FETCH_ASSOC)) {
            $music = "Audios/" . str_replace(" ", "_", $courant['loginUser'] . $courant['titre']) . ".mp3";
            ?>var myCirclePlayer<?php echo($i) ?> = new CirclePlayer("#jquery_jplayer_<?php echo($i) ?>",
                        {
                        m4a: "<?php echo($music); ?>",
                        }, {
                        cssSelectorAncestor: "#cp_container_<?php echo($i) ?>",
                        });
            <?php
            $i = $i + 1;
        }
        ?>});
        </script><?php
        return true;
    }

    //Fonction qui permet d'afficher les $number dernières musiques de genre $genre ajoutées sur le site
    public static function afficherLastMusiquesGenre($dbh, $genre, $number) {
        $query = "SELECT * FROM `audio` WHERE `genre`=? ORDER BY id DESC LIMIT " . $number;
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($genre));
        $i = 1;
        if ($rows = $sth->rowCount() == 0)
            echo '<p style="font-size:25px; margin-left : 200px">Cette page manque de contenu .. On compte sur vous ! </p>';
        else {
            while ($courant = $sth->fetch(PDO::FETCH_ASSOC)) {
                $music = "Audios/" . str_replace(" ", "_", $courant['loginUser'] . $courant['titre']) . ".mp3";

                printPlayer($i, $courant, $dbh);
                $i = $i + 1;
            }
        }
        ?><script type="text/javascript">
            $(document).ready(function () {
        <?php
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($genre));
        $i = 1;

        while ($courant = $sth->fetch(PDO::FETCH_ASSOC)) {
            $music = "Audios/" . str_replace(" ", "_", $courant['loginUser'] . $courant['titre']) . ".mp3";
            ?>var myCirclePlayer<?php echo($i) ?> = new CirclePlayer("#jquery_jplayer_<?php echo($i) ?>",
                        {
                        m4a: "<?php echo($music); ?>",
                        }, {
                        cssSelectorAncestor: "#cp_container_<?php echo($i) ?>",
                        });
            <?php
            $i = $i + 1;
        }
        ?>});
        </script><?php
        return true;
    }

    //Fonction qui permet d'afficher les $number dernières musiques ajoutées sur le site par l'utilisateur $login
    public static function afficherLastMusiquesUser($dbh, $login, $number) {
        $query = "SELECT * FROM `audio` WHERE loginUser=? ORDER BY id DESC LIMIT " . $number;
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($login));
        $i = 1;
        while ($courant = $sth->fetch(PDO::FETCH_ASSOC)) {
            $music = "Audios/" . str_replace(" ", "_", $courant['loginUser'] . $courant['titre']) . ".mp3";


            printPlayer($i, $courant, $dbh);
            $i = $i + 1;
        }
        ?><script type="text/javascript">
            $(document).ready(function () {
        <?php
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($login));
        $i = 1;

        while ($courant = $sth->fetch(PDO::FETCH_ASSOC)) {
            $music = "Audios/" . str_replace(" ", "_", $courant['loginUser'] . $courant['titre']) . ".mp3";
            ?>var myCirclePlayer<?php echo($i) ?> = new CirclePlayer("#jquery_jplayer_<?php echo($i) ?>",
                        {
                        m4a: "<?php echo($music); ?>",
                        }, {
                        cssSelectorAncestor: "#cp_container_<?php echo($i) ?>",
                        });
            <?php
            $i = $i + 1;
        }
        ?>});
        </script><?php
        return true;
    }

    //Retourne le nombre de fichiers postés par $login
    public static function nbPostsParLogin($dbh, $login) {
        $query = "SELECT * FROM audio WHERE loginUser =? ";
        $sth = $dbh->prepare($query);
        $sth->execute(array($login));
        return $rows = $sth->rowCount();
    }

    //Fonction qui permet d'afficher les $number dernières musiques likées par l'utilisateur $login
    public static function afficherLastMusiquesLikedByUser($dbh, $login, $number) {
        $query = "SELECT * FROM `audio` JOIN jaime WHERE jaime.login=? AND audio.id=jaime.id "
                . " ORDER BY jaime.id DESC LIMIT " . $number;
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($login));
        $i = 11;
        while ($courant = $sth->fetch(PDO::FETCH_ASSOC)) {
            $music = "Audios/" . str_replace(" ", "_", $courant['loginUser'] . $courant['titre']) . ".mp3";


            printPlayer($i, $courant, $dbh);
            $i = $i + 1;
        }
        ?><script type="text/javascript">
            $(document).ready(function () {
        <?php
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($login));
        $i = 11;

        while ($courant = $sth->fetch(PDO::FETCH_ASSOC)) {
            $music = "Audios/" . str_replace(" ", "_", $courant['loginUser'] . $courant['titre']) . ".mp3";
            ?>var myCirclePlayer<?php echo($i) ?> = new CirclePlayer("#jquery_jplayer_<?php echo($i) ?>",
                        {
                        m4a: "<?php echo($music); ?>",
                        }, {
                        cssSelectorAncestor: "#cp_container_<?php echo($i) ?>",
                        });
            <?php
            $i = $i + 1;
        }
        ?>});
        </script><?php
        return true;
    }

}
?>
