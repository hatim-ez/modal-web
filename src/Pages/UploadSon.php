

<?php

if (!empty($_FILES['fichier']['tmp_name']) && is_uploaded_file($_FILES['fichier']['tmp_name'])) {
// Le fichier a bien été téléchargé
// Par sécurité on utilise getimagesize plutot que les variables $_FILES

    if (Audio::isAudioExisting($dbh, $_SESSION['login'], $_POST['titleSong'])) {
        $_SESSION['erreur'] = "titreDejaPoste";
    } else {
        list($larg, $haut, $type, $attr) = getimagesize($_FILES['fichier']['tmp_name']);


        //Attention, probleme de sécurité, le nom du fichier peut etre changé par l'utilisateur
        $extension = substr($_FILES['fichier']['type'], -3); // Récupération de l'extension
        if ($extension == 'mp3') {
            if (move_uploaded_file($_FILES['fichier']['tmp_name'], 'Audios/' . str_replace(' ', '_', $_SESSION['login'] . $_POST['titleSong']) . '.mp3')) {
                
            } else {
                $_SESSION['erreur'] = "echec de la copie";
                $askedPage = 'MonCompteUploadSonEchec';
                //echo'echec copie';
            }
        } else {
            $_SESSION['erreur'] = "mauvais type de fichier ";
            $askedPage = 'MonCompteUploadSonEchec';
        }

        //echo'mauvais fichier ';
    }
}

