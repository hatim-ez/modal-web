<?php

$sel = "jdfd6g4zf!sjfhhgfJsha5874dekjYhhe";

class Utilisateurs {

    public $nom;
    public $prenom;
    public $naissance;
    public $email;
    public $mdp;
    public $login; //le pseudo

    public function affiche() {
        echo "[" . $this->login . "] " . $this->nom . " " . $this->prenom . " né(e) le " . $this->naissance;
    }

    public function __toString() {
        return "[" . $this->login . "] " . $this->nom . " " . $this->prenom . " né(e) le " . $this->naissance;
    }

    public static function getUser($dbh, $login) {
        $query = "SELECT * FROM Utilisateurs WHERE login = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateurs');
        $sth->execute(array($login));
        $user = $sth->fetch();
        $sth->closeCursor();
        if ($user == null) {
            return null;
        } else {
            return $user;
        }
    }

    public static function getPrenomUtilisateur($dbh, $log) {
        return Utilisateurs::getUser($dbh, $log)->prenom;
    }

    public static function getLoginUtilisateur($dbh, $log) {
        return Utilisateurs::getUser($dbh, $log)->login;
    }

    public static function getNomUtilisateur($dbh, $log) {
        return Utilisateurs::getUser($dbh, $log)->nom;
    }

    public static function isMailExisting($dbh, $Mail) {
        $query = "SELECT * FROM Utilisateurs WHERE email = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateurs');
        $sth->execute(array($Mail));
        $user = $sth->fetch();
        $sth->closeCursor();
        if ($user == null) {
            return false;
        } else {
            return true;
        }
    }

    public static function getMailUtilisateur($dbh, $log) {
        return Utilisateurs::getUser($dbh, $log)->email;
    }

//fonction qui vérifie la correspondance login/mdp
    public static function testerMdp($dbh, $login, $mdp) {
        global $sel;
        $query = "SELECT * FROM Utilisateurs WHERE login = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateurs');
        $sth->execute(array($login));
        $user = $sth->fetch();
        $sth->closeCursor();
        $motDePasse = $user->Mdp;

        if ($motDePasse == SHA1($mdp . $sel)) {
            return true;
        } else {
            return false;
        }
    }

    //Même fonction, mais plus efficace car prend en paramètre l'objet utilisateur plutôt que la chaine de caractères login
    public static function testerMdpBis($user, $Mdp) {
        global $sel;
        $motDePasse = $user->mdp;

        if ($motDePasse == SHA1($Mdp . $sel)) {
            return true;
        } else {
            return false;
        }
    }

    public static function insererUtilisateur($dbh, $login, $mdp, $Nom, $Prenom, $email) {
        global $sel;
        $sth = $dbh->prepare("INSERT INTO Utilisateurs VALUES(?,SHA1(?),?,?, NULL, ?, NULL)");
        $sth->execute(array($login, $mdp . $sel, $Nom, $Prenom, $email));
        return true;
    }

    // Modifie le mot de passe de l'utilisateur repéré par son login    
    public static function modifierMdp($dbh, $log, $nouveauMdp) {
        global $sel;


        $query = "UPDATE Utilisateurs SET mdp=? WHERE login = ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array(SHA1($nouveauMdp . $sel), $log));
        $_SESSION['mdp'] = $nouveauMdp;
        $_SESSION['user'] = Utilisateurs::getUser($dbh, $_SESSION['login']);
    }

    // Supprime le compte associé au login 

    public static function supprimerCompte($dbh, $log, $password) {
        global $sel;
        $sth = $dbh->prepare("DELETE FROM Utilisateurs WHERE login=? AND mdp=SHA1(?)");
        $sth->execute(array($log, $password . $sel));
    }

    //Permet à un admin de supprimer n'importe quel compte
    public static function supprimerCompteAdmin($dbh, $login) {
        $sth = $dbh->prepare("DELETE FROM Utilisateurs WHERE login=? ");
        $sth->execute(array($login));
    }

    //Retourne le nombre de postes likés par l'utilisateur $login
    public static function nbLikesParLogin($dbh, $login) {
        $query = "SELECT * FROM jaime WHERE login =? ";
        $sth = $dbh->prepare($query);
        $sth->execute(array($login));
        return $rows = $sth->rowCount();
    }

}

?>
