

<?php

// ex pour une image jpg
if (!empty($_FILES['fichier']['tmp_name']) && is_uploaded_file($_FILES['fichier']['tmp_name'])) {
// Le fichier a bien été téléchargé
// Par sécurité on utilise getimagesize plutot que les variables $_FILES
    list($larg, $haut, $type, $attr) = getimagesize($_FILES['fichier']['tmp_name']);
// JPEG => type=2
    if ($type == 2) {
        if (move_uploaded_file($_FILES['fichier']['tmp_name'], 'Images/img' . Utilisateurs::getLoginUtilisateur($dbh, $_SESSION['login']) . '.jpg')) {
            
        } else {
            $_SESSION['erreur'] = "echecCopie";
        }
    } else
        $_SESSION['erreur'] = "mauvaisTypeFfichier ";
}

