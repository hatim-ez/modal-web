<?php

//Liste des admins
$administrateurs = array("olivier");

//Connexion
function logIn($dbh) {
    //On s'assure que les champs ont bien été remplis
    if (isset($_POST['loginConnexion']) && isset($_POST['mdpConnexion'])) {
        $login = $_POST['loginConnexion'];
        $mdp = $_POST['mdpConnexion'];
        $boolAdmin = false;

        //On check si le login entré correspond bien à un utilisateur
        $user = Utilisateurs::getUser($dbh, $login);
        if ($user != NULL) {


            //On check maintenant si le mot de passe entré est le bon
            if (Utilisateurs::testerMdpBis($user, $mdp)) {
                //On check s'il s'agit d'un admin
                global $administrateurs;
                foreach ($administrateurs as $loginAdmin) {
                    if ($loginAdmin == $login) {
                        $boolAdmin = true;
                        break;
                    }
                }
                $boolAdmin ? $_SESSION['admin'] = true : $_SESSION['admin'] = false;
                $_SESSION['loggedIn'] = true;
                $_SESSION['user'] = $user;
                $_SESSION['login'] = $user->login;
                $_SESSION['mdp'] = $user->mdp;
                $_SESSION['prenom'] = $user->prenom;
                $_SESSION['nom'] = $user->nom;
                $_SESSION['email'] = $user->email;
                $_SESSION['naissance'] = $user->naissance;
                return $_SESSION['namePrec'];
            } else {
                $_SESSION['erreur'] = 'forgetmdp';
                return "SeConnecter";
            }
        } else {
            $_SESSION['erreur'] = 'forgetlogin';
            return "SeConnecter";
        }
    }
    return "SeConnecter";
}

//Déconnexion
function logOut() {
    $_SESSION['loggedIn'] = false; // Déconnexion 
    //Unset les variables de session
    unset($_SESSION['login']);
    unset($_SESSION['mdp']);
    unset($_SESSION['prenom']);
    unset($_SESSION['nom']);
    unset($_SESSION['email']);
    unset($_SESSION['naissance']);
    unset($_SESSION['admin']);
}

//Inscription
function register($dbh) {
    //On vérifie que tous les champs ont bien été remplis
    if (isset($_POST['login']) && isset($_POST['password1']) && isset($_POST['password2']) && isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['email'])) {
        //On vérifie que les champs remplis n'utilisent pas de caractères spéciaux, pouvant poser des problèmes de sécurite
        if (!checkTxt($_POST['login'])) {
            $_SESSION['erreur'] = 'loginInvalide';
            return  'SeConnecter';
            
        }
        if (!checkTxt($_POST['password1']) || !checkTxt($_POST['password2'])) {
            $_SESSION['erreur'] = 'mdpInvalide';
            return  'SeConnecter';
            
        }
        if ($_POST['password1'] != $_POST['password2']) {
            $_SESSION['erreur'] = 'mdpDifferents';
            return'SeConnecter';
            
        }
        if (!checkTxt($_POST['prenom'])) {
            $_SESSION['erreur'] = 'prenomInvalide';
            return 'SeConnecter';
           
        }
        if (!checkTxt($_POST['nom'])) {
            $_SESSION['erreur'] = 'nomInvalide';
            return 'SeConnecter';
        }
        if (!checkTxt($_POST['mail'])) {
            $_SESSION['erreur'] = 'mailInvalide';
            return 'SeConnecter';
        }
        // Cherche si le login a déjà été utilisé ; si oui, il faut en trouver un autre 
        if (Utilisateurs::getUser($dbh, $_POST['login']) != NULL) {
            $_SESSION['erreur'] = 'loginexistant';
            return 'SeConnecter';
            
        }
        //Cherche si le mail a déjà été utilisé ; si oui, il faut en trouver un autre 
        if (Utilisateurs::isMailExisting($dbh, $_POST['email'])) {
            $_SESSION['erreur'] = 'mailExistant';
            return'SeConnecter';
            
        }
        //Si tous les identifiants conviennent, on ajoute l'utilisateur 

        $login = $_POST['login'];
        $mdp = $_POST['password1'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        Utilisateurs::insererUtilisateur($dbh, $_POST['login'], $_POST['password1'], $_POST['nom'], $_POST['prenom'], $_POST['email'], null);

        $_SESSION['login'] = $login;
        $_SESSION['mdp'] = $mdp;
        $_SESSION['loggedIn'] = true;

        $user = Utilisateurs::getUser($dbh, $_POST['login']);
        $_SESSION['user'] = $user;
        $_SESSION['prenom'] = $user->prenom;
        $_SESSION['nom'] = $user->nom;
        $_SESSION['email'] = $user->email;
        $_SESSION['naissance'] = $user->naissance;

        login($dbh);
        return $_SESSION['namePrec'];
    }
}

//Fonction qui permet de changer le mot de passe
function changerPassword($dbh) {

    // On vérifie d'abord que les champs sont remplis 
    if (isset($_POST['ancienMdp']) && isset($_POST['newMdp']) && isset($_POST['newMdpBis'])) {
        // On vérifie que les champs remplis par l'utilisateur sont convenables 
        if (!checkTxt($_POST['ancienMdp']) || !checkTxt($_POST['newMdp']) || !checkTxt($_POST['newMdpBis'])) {
            $_SESSION['erreur'] = "mdpInvalide";

            return 'ChangePassword';
        }

        // Partie mot de passe 

        //Puis on vérifie que les deux entrées pour le nouveau mot de passe sont identiques 
        elseif ($_POST['newMdp'] != $_POST['newMdpBis']) {
            $_SESSION['erreur'] = "mdpdifferents";
            return 'ChangePassword';
        }



        // Enfin on vérifie que l'ancien mot de passe entré dans le formulaire est identique au mot de passe associé dans la base à l'utilisateur en question 
        elseif (Utilisateurs::testerMdpBis($_SESSION['user'], $_POST['ancienMdp']) == false) {
            $_SESSION['erreur'] = 'falsemdp';
            echo $_POST["ancienMdp"];

            return 'ChangePassword';
        }

        // Si tout va bien jusque là, mettre à jour le mot de passe haché (fonction SHA1($passwd)) dans la base de données
        else {
            Utilisateurs::modifierMdp($dbh, $_SESSION['login'], $_POST['newMdp']);
            return 'SuccesModificationMdp';
        }
    }
    $_SESSION['erreur'] = 'champs non remplis';
    return 'ChangePassword';
}

// Supprime le compte de l'utilisateur du compte courant
function deleteUser($dbh) {
    Utilisateurs::supprimerCompte($dbh, $_SESSION['login'], $_SESSION['mdp']);
    logOut();
    return 'DeleteUser';
}

// Supprime le compte de l'utilisateur du compte courant si c'est un admin
function deleteUserAdmin($dbh, $login) {
    if (isset($_SESSION['admin']) && $_SESSION['admin']) {
        Utilisateurs::supprimerCompteAdmin($dbh, $login);

        return 'DeleteUserAdmin';
    } else {
        $_SESSION['erreur'] = "nonAuthorized";
    }
}

//Fonction qui permet d'upload un son
function uploadSon($dbh) {
    if (Audio::isAudioExisting($dbh, $_SESSION['login'], $_POST['titleSong'])) {
        $_SESSION['erreur'] = "titreDejaPoste";
        return'MonCompteUploadSonEchec';
    } else {
        Audio::insererAudio($dbh, $_SESSION['login'], $_POST['titleSong'], $_POST['artiste'], $_POST['album'], $_POST['anneePublication'], $_POST['genre'], $_POST['description']);
        return 'MonCompteUploadSonSucces';
    }
}
