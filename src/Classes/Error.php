<?php

//Fonction qui permet d'afficher une erreur 
function printErreur() {
    switch ($_SESSION['erreur']) {

        //Upload
        case 'echecCopie':
            echo "<h1 > La copie du fichier a échoué. </h1> <br>";
            break;

        case 'mauvaisTypeFichier':
            echo "<h1> Le fichier que vous avez essayé d'uploader n'est pas un fichier mp3. </h1> <br>";
            break;

        case 'titreDejaPoste':
            echo "<h1 style='float:right ; display:block'> Désolé, nous n'avons pu uploader votre fichier car vous avez déjà posté ce titre</h1> <br>";
            break;

        /* On aurait pu imposer une longueur minimale du mot de passe à l'inscription
        
          case 'mdptropcourt':
            echo '<h1 >Votre mot de passe doit posséder au moins 6 caractères</h1><br/><br/>';
            break;
         
         */


        case 'falsemdp':
            echo'<h1 > Vous vous êtes trompés sur l\'ancien mot de passe</h1><br/><br/>';
            break;
        case 'forgetmdp' :
            echo '<h1 >Vous vous êtes trompés sur la valeur de votre mot de passe</h1><br/><br/>';
            break;
        case 'forgetlogin':
            echo '<h1 >Vous vous êtes trompés sur la valeur de votre identifiant</h1><br/><br/>';
            break;


        case 'searchInvalide':
            echo '<h1> Requête invalide </h1>';
            break;

        /* Partie Secure */

        case "profilInexistant":
            echo '<h1 >Ce profil n\'existe pas</h1><br/><br/>';
            break;

        case 'nonAuthorized':
            echo '<h1 >La page que vous avez demandée n\'est pas accessible</h1><br/><br/>';
            break;

        //Inscription
        case 'mdpDifferents':
            echo '<h1 >Il y a une différence dans le mot de passe et votre confirmation de mot de passe</h1><br/><br/>';
            break;
        case 'loginInvalide':
            echo '<h1 >Le pseudo que vous avez rentré est invalide</h1><br/><br/>';
            break;
        case 'loginexistant':
            echo'<h1>ce login est déjà utilisé, veuillez en choisir un autre</h1><br/><br/>';
            break;

        case 'mailexistant':
            echo'<h1 >Ce mail est déjà utilisé, veuillez en choisir un autre</h1><br/><br/>';
            break;
        case 'mdpInvalide':
            echo '<h1 >Le mot de passe que vous avez rentré est invalide</h1><br/><br/>';
            break;
        case 'prenomInvalide':
            echo '<h1 >Ce n\'est pas un prénom ça!</h1><br/><br/>';
            break;
        case 'nomInvalide':
            echo '<h1 >Ce n\'est pas un nom ça!</h1><br/><br/>';
            break;
        case 'mailInvalide':
            echo '<h1 >L\'email que vous avez rentré est invalide</h1><br/><br/>';
            break;
    }

    //On n'oublie pas de supprimer la variable 'erreur' de session après l'avoir affichée
    unset($_SESSION['erreur']);
}
