<?php

require ("Classes/Utilisateurs.php");
require ("Classes/Audio.php");
require ('Classes/Database.php');
require ('Classes/Commentaires.php');


session_name("MusiX");
session_start();


require ("Classes/Error.php");

require ("Classes/Securite.php");
require ("Classes/LogInOut.php");
require ("Classes/PrintForms.php");
require("utils.php");

$dbh = Database::connect();

// code de sélection des pages, comme précédemment
if (isset($_GET["name"])) {
    $askedPage = $_GET["name"];
} else {
    $askedPage = 'Accueil';
}



// traitement des contenus de formulaires
if (isset($_GET['todo'])) {
    switch ($_GET['todo']) {

        case "login":
            $askedPage = logIn($dbh);
            break;
        case "register":
            $askedPage=register($dbh);
            break;

        case "search":
            $askedPage = "Search";
            break;


        case 'logout':
            logOut();
            $askedPage = "Accueil";
            break;

        case 'changemdp':
            $askedPage = changerPassword($dbh);

            break;

        case 'jaime':
            if (isset($_SESSION['login'])) {
                $query = "SELECT * FROM `jaime` WHERE `id` = ? AND `login` = ?";
                $sth = $dbh->prepare($query);
                $request_succeeded = $sth->execute(array($_GET['id'], $_SESSION['login']));
                $rows = $sth->rowCount();
                if ($rows == 0) {
                    $sth = $dbh->prepare("INSERT INTO jaime VALUES(?, ?)");
                    $sth->execute(array($_GET['id'], $_SESSION['login'],));
                }
            }
            break;

        case 'annulerjaime':
            $sth = $dbh->prepare("DELETE FROM jaime WHERE `id` = ? AND `login` = ?");
            $sth->execute(array($_GET['id'], $_SESSION['login']));
            break;

        case 'commenter':
            if (isset($_SESSION['login']) && isset($_POST['comment'])) {
                Commentaires::insererCommentaire($dbh, $_SESSION['login'], date('Y-m-d H:i:s'), $_POST['comment'], $_GET['id']);
            }
            break;

        case 'modifiercommentaire':
            if (isset($_SESSION['login']) && isset($_POST['mcomment' . $_GET['idcomment']])) {
                Commentaires::modifierCommentaire($dbh, $_POST['mcomment' . $_GET['idcomment']], $_GET['idcomment']);
            }
            break;

        case 'supprimercommentaire':
            $query = "SELECT * FROM `commentaires` WHERE `idcomment` = ?";
            $sth = $dbh->prepare($query);
            $request_succeeded = $sth->execute(array($_GET['idcomment']));
            while ($courant = $sth->fetch(PDO::FETCH_ASSOC)) {
                if ($courant['login'] == $_SESSION['login'] || $_SESSION['admin']) {
                    Commentaires::supprimerCommentaire($dbh, $_GET['idcomment']);
                }
            }
            break;


        /* Permet à l'utilisateur de supprimer son compte */
        case 'deleteUser':
            $askedPage = DeleteUser($dbh);
            break;

        case 'deleteUserAdmin':
            $askedPage = deleteUserAdmin($dbh, $_GET['loginCherche']);
            break;

        case 'uploadimgavatar':
            require('Pages/UploadPicture.php');
            $askedPage = "MonCompteMusique";
            break;
        case 'uploadson':
            require('Pages/UploadSon.php');
            $askedPage = uploadSon($dbh);
            break;

        case 'deleteAudio':
            Audio::deleteAudiobyId($dbh, $_GET['idAudio']);
            break;

        case 'changeTagAudioAdmin':
            Audio::changeTagAudioById($dbh, $_GET['idAudio'], $_POST['genreAdmin']);
            $askedPage = $_GET['name'];
            break;
    }
}


$authorized = checkPage($askedPage);
if ($authorized == true) {
    $pageTitle = getPageTitle($askedPage);



    generateHTMLHeader($pageTitle, "css/perso.css");
    generateMenu($pageTitle);

    if (isset($_SESSION['erreur'])) {
        printErreur();
    }
    require ("Pages/" . $askedPage . ".php");
} else {

    generateHTMLHeader("Error", "css/perso.css");
    generateMenu("Error");
    $_SESSION['erreur'] = "nonAuthorized";
    $pageTitle = "Error";
}



if (isset($_SESSION['erreur'])) {
    printErreur();
}



generateHTMLFooter();
?>