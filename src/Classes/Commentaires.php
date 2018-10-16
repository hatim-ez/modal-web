<?php

class Commentaires {

    public $idmusic;
    public $login;
    public $date;
    public $commentaire;
    public $idcomment;

    //Ajoute un commentaire à la musique d'id $idmusic
    public static function insererCommentaire($dbh, $login, $date, $commentaire, $idmusic) {
        $sth = $dbh->prepare("INSERT INTO commentaires VALUES( ?, ?, ?,?,NULL)");
        $sth->execute(array($idmusic, $login, $date, $commentaire));
        return true;
    }

    //Affiche tous les commentaires postés sur la musique d'id $idmusic
    public static function afficherCommentaires($dbh, $idmusic) {        
        $query = "SELECT * FROM `commentaires` WHERE `idmusic` = " . $idmusic . " ORDER BY `idcomment` DESC";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute();
        echo'<p style="font-size: 20px;font-family: sans-serif; color:silver; font-weight: bold;">Commentaires<p>';
        while ($courant = $sth->fetch(PDO::FETCH_ASSOC)) {

            echo'<div class="row" style="height:20px"></div>';
            echo'<p style="display: inline-block; color: silver; font-size: 15px;font-family: sans-serif;">' . $courant['login'] . ' le ' . substr($courant['date'], 0, 10) . ' à ' . substr($courant['date'], 11) . '</p>';
            if (isset($_SESSION['login']) && ( $_SESSION['login'] == $courant['login'] || $_SESSION['admin'])) {
                ?>

                <!-- Bouton qui permet de supprimer un commentaire si c'est l'utilisateur connecté qui l'a posté ou bien si un admin est connecté-->
                <a data-toggle="tooltip" title="Supprimer mon commentaire" data-placement="top" class="btn btn-default btn-sm" style = "margin-left: 10px" href="index.php?name=<?php echo $_GET['name'] ?>&todo=supprimercommentaire&idcomment=<?php echo $courant['idcomment'] ?>">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a> 
                <!-- Bouton qui permet de modifier un commentaire si c'est l'utilisateur connecté qui l'a posté ou bien si un admin est connecté-->
                <span data-toggle="tooltip" title="Modifier mon commentaire" data-placement="top">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#mymodifyModal<?php echo $courant['idcomment'] ?>" style = "margin-left: 5px">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </button>
                </span>
                <!-- Modal -->
                <div class="modal fade" id="mymodifyModal<?php echo $courant['idcomment'] ?>" role="dialog">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <form method="post" action="index.php?name=<?php echo $_GET['name'] ?>&idcomment=<?php echo $courant['idcomment'] ?>&todo=modifiercommentaire<?php
                            if (isset($_SESSION['loginCherche'])) {
                                echo '&loginCherche=' . $_SESSION['loginCherche'];
                            }
                            ?>
                                  " enctype='multipart/form-data'>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <label class="form-control-label">Votre Commentaire:</label>
                                        <textarea class="form-control" name="mcomment<?php echo $courant['idcomment'] ?>" id="mcomment<?php echo $courant['idcomment'] ?>" required="required" rows="5"><?php echo $courant['commentaire'] ?></textarea>                                                        
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input type="submit" class="btn btn-primary"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            echo'<p style="color: inherit; font-size: 15px;font-family: sans-serif;text-align: justify;">' . $courant['commentaire'] . '</p>';
        }
        return true;
    }

    public static function supprimerCommentaire($dbh, $idcomment) {
        $query = "DELETE FROM `commentaires` WHERE `idcomment` = ?";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($idcomment));
    }

    public static function modifierCommentaire($dbh, $newcomment, $idcomment) {
        $query = "UPDATE `commentaires` SET `commentaire` = ? WHERE `idcomment` = ?";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($newcomment, $idcomment));
    }

    public static function nbCommParLogin($dbh, $login) {
        $query = "SELECT * FROM commentaires WHERE login =? ";
        $sth = $dbh->prepare($query);
        $sth->execute(array($login));
        return $rows = $sth->rowCount();
    }

}
