<?php
//Liste des pages
$page_list = array(
    array(
        "name" => "Accueil",
        "title" => "Musix, une nouvelle plateforme musicale faite pour vous",
        "menutitle" => "Accueil"),
    array(
        "name" => "SeConnecter",
        "title" => "Rejoins-nous !",
        "menutitle" => "Connexion"),
    array(
        "name" => "Search",
        "title" => "Résultats de votre recherche",
        "menutitle" => "Recherche"),
    array(
        "name" => "PageUtilisateur",
        "title" => "A la découverte de notre communauté",
        "menutitle" => "ParcourirUtilisateur"),
    array(
        "name" => "Inscription",
        "title" => "Inscription",
        "menutitle" => "Inscription"),
    array(
        "name" => "ChangePassword",
        "title" => "Changez votre mot de Passe",
        "menutitle" => "Modification mdp"),
    array(
        "name" => "MonCompte",
        "title" => "Bienvenue sur votre espace personnel",
        "menutitle" => "MonCompte"),
    array(
        "name" => "Stream",
        "title" => "Dernières nouveautés",
        "menutitle" => "Stream"),
    array(
        "name" => "Parcourir",
        "title" => "Explorer l'univers musical",
        "menutitle" => "Parcourir"),
    array(
        "name" => "MonCompteInformation",
        "title" => "Vos Informations",
        "menutitle" => "Info"),
    array(
        "name" => "MonCompteUploadSon",
        "title" => "Envie de partager une musique ?",
        "menutitle" => "UploadSon"),
    array(
        "name" => "MonCompteUploadSonSucces",
        "title" => "Merci !",
        "menutitle" => "UploadSonSucces"),
    array(
        "name" => "MonCompteUploadSonEchec",
        "title" => "L'upload a échoué",
        "menutitle" => "UploadSonEchec"),
    array(
        "name" => "MonCompteMusique",
        "title" => "Vos Musiques",
        "menutitle" => "CompteMusique"),
    array(
        "name" => "DeleteUser",
        "title" => "A Bientôt",
        "menutitle" => "DeleteUser"),
    array(
        "name" => "DeleteUserAdmin",
        "title" => "",
        "menutitle" => "DeleteUserAdmin"),
    array(
        "name" => "SuccesModificationMdp",
        "title" => "Modification effectuée",
        "menutitle" => "ModiferMdp"),
    array(
        "name" => "commentaire",
        "title" => "Stream",
        "menutitle" => "comment"),
    //Les pages correspondant aux 13 différents genres de "parcourir"
    array(
        "name" => "ParcourirGenres/classique",
        "title" => "Ecoutez les derniers sons Classiques",
        "menutitle" => "Classique"),
    array(
        "name" => "ParcourirGenres/country",
        "title" => "Ecoutez les derniers sons Country",
        "menutitle" => "Country"),
    array(
        "name" => "ParcourirGenres/electro",
        "title" => "Ecoutez les derniers sons Electro",
        "menutitle" => "Electro"),
    array(
        "name" => "ParcourirGenres/funk",
        "title" => "Ecoutez les derniers sons Funk",
        "menutitle" => "Funk"),
    array(
        "name" => "ParcourirGenres/hiphop",
        "title" => "Ecoutez les derniers sons Hip-Hop",
        "menutitle" => "Hip-Hop"),
    array(
        "name" => "ParcourirGenres/jazz",
        "title" => "Ecoutez les derniers sons Jazz",
        "menutitle" => "Jazz"),
    array(
        "name" => "ParcourirGenres/metal",
        "title" => "Ecoutez les derniers sons Metal",
        "menutitle" => "Metal"),
    array(
        "name" => "ParcourirGenres/pop",
        "title" => "Ecoutez les derniers sons Pop",
        "menutitle" => "Pop"),
    array(
        "name" => "ParcourirGenres/reggae",
        "title" => "Ecoutez les derniers sons Reggae",
        "menutitle" => "Reggae"),
    array(
        "name" => "ParcourirGenres/rnb",
        "title" => "Ecoutez les derniers sons RnB",
        "menutitle" => "RnB"),
    array(
        "name" => "ParcourirGenres/rock",
        "title" => "Ecoutez les derniers sons Rock",
        "menutitle" => "Rock"),
    array(
        "name" => "ParcourirGenres/variete",
        "title" => "Ecoutez les derniers sons de Variété",
        "menutitle" => "Variété"),
    array(
        "name" => "ParcourirGenres/sansetiquette",
        "title" => "Ecoutez les derniers sons non classés",
        "menutitle" => "SansEtiquette"),
);

//Si la personne est connectée, on change le titre de la page "MonCompte" afin d'afficher "Bienvenue" + login
if (isset($_SESSION['login'])) {
    foreach ($page_list as $key => $page) {

        if ($page['name'] == "MonCompteMusique") {

            $page_list[$key]["title"] = "Bienvenue " . Utilisateurs::getPrenomUtilisateur(Database::connect(), $_SESSION['login']);
        }
    }
}

//On vérifie si la page demandée appartient bien à notre ensemble de page
function checkPage($askedPage) {
    global $page_list;
    foreach ($page_list as $page) {
        if ($page['name'] == $askedPage) {
            return true;
        }
    }
    return false;
}

//Récupère le titre d'une page 
function getPageTitle($askedPage) {
    global $page_list;
    foreach ($page_list as $page) {
        if ($page['name'] == $askedPage) {
            return $page['title'];
        }
    }
}

//On génère le header
function generateHTMLHeader($titre, $cssfile) {
    echo '
         <!DOCTYPE html>
         <html>
         <head>
           <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
            <meta name="author" content="Barthelemy et Hatim"/>
            <meta content="record, sounds, share, sound, audio, tracks, music, musiX" name="keywords">';



    echo'  
              
        <link href="css/circle.player.css" rel="stylesheet">

        <script type="text/javascript" src="lib/jquery.min.js"></script>
        
        <script type="text/javascript" src="plugins/circleplayer/jquery.transform2d.js"></script>
        <script type="text/javascript" src="plugins/circleplayer/jquery.grab.js"></script>
        <script type="text/javascript" src="plugins/circleplayer/jquery.jplayer.js"></script>
        <script type="text/javascript" src="plugins/circleplayer/mod.csstransforms.min.js"></script>
        <script type="text/javascript" src="plugins/circleplayer/circle.player.js"></script>
        
<link href="css/bootstrap.css" rel="stylesheet">
            
    <!-- Pour les formulaires login/signup dynamiques -->
<link rel="stylesheet" type="text/css" href="css/css-formulaires_login/animate-custom.css">
<link rel="stylesheet" type="text/css" href="css/css-formulaires_login/style.css">
<link rel="stylesheet" type="text/css" href="css/css-formulaires_login/demo.css">
<script type="text/javascript" async="" src="https://ssl.google-analytics.com/ga.js"></script>

            
        <script src="js/bootstrap.js"> </script>';


    echo' <link   href=' . $cssfile . ' rel="stylesheet" />
            <title >' . $titre . '</title></head>';

    echo '<body>';
}

function generateHTMLFooter() {
    echo '
           </body>
            </html>';
}

//On génère la barre de menu
function generateMenu($titre) {
    require('Pages/Menu.php');
    echo '<h1 class="titlePage" >' . $titre . '</h1>';

    echo'<br/>';
}

//Fonction qui permet d'effectuer une recherche
function search($dbh, $recherche) {
    //Script qui permet d'osciller entre recherche d'utilisateurs et d'audio
    ?> 
    <script type="text/javascript">
        $(document).ready(function () {
            $("#searchUser").show();
            $("#searchAudio").hide();
            $("#button_toggle").click(function () {
                $("#searchUser").toggle();
                $("#searchAudio").toggle();
            });
            $("#button_toggle2").click(function () {
                $("#searchUser").toggle();
                $("#searchAudio").toggle();
            });
        });
    </script>





    <!--On cherche les utilisateurs -->
    <div id="searchUser" style="display:show;" >
        <button  disabled="disabled" 
                 style="display:inline;margin-left: 600px;  background-color: #ccc;  " >
            Utilisateurs
        </button> 
        <button id="button_toggle" class="aEnfoncer"
                style="display:inline;  background-color: #ccc;  " >
            Audio
        </button> 

        <br><br>
        <?php
        $query = "SELECT * FROM Utilisateurs WHERE login LIKE '%' ? '%'";
        $sth = $dbh->prepare($query);
        $sth->execute(array($recherche));
        if ($rows = $sth->rowCount() == 0) {
            echo '<p id = "searchUser" style="font-size:25px; margin-left : 200px; display:hidden">Il n\'y a pas d\'utilisateurs correspondant à votre recherche </p>';
        }
        while ($courant = $sth->fetch(PDO::FETCH_ASSOC)) {
            echo ' <div class="col-md-11" > <div class="well sidebar-nav" style="background-color:#101010; border-color:silver; margin-left:120px; border-width:3px; height:200px ">
             ';
            echo '<div class="col-md-4">';
            if (file_exists("Images/img" . $courant['login'] . ".jpg")) {

                echo '<img id="img-avatar"   class="img-userlogo" style="height : 160px" src="Images/img' . $courant['login'] . '.jpg" alt=""  >';
            } else {
                echo ' <img id="img-avatar" class="img-userlogo" style="height : 160px" src="Images/imgAvatar.jpg" alt=""  >';
            }
            echo '</div>';

            echo '<div class="col-md-8"><h1 style="text-align: center; font-size: 40px; font-weight: bold"> <a  href="?name=PageUtilisateur&loginCherche=' . $courant['login'] . '">' . $courant['login']
            . '</a> </h1> <br> '
            . '<p>Nombre de posts : ' . Audio::nbPostsParLogin($dbh, $courant['login']) . '</p>';
            echo '<p>A liké ' . Utilisateurs::nbLikesParLogin($dbh, $courant['login']) . ' posts</p>';
            echo '<p>Nombre de commentaires postés : ' . Commentaires::nbCommParLogin($dbh, $courant['login']) . '</p>';
            echo '</div> ';

            echo '</div> <br></div>';
        }
        echo '</div>';
        
        //On cherche les Audios
        ?>
        <div id ="searchAudio" style="display:hidden">
            <button id="button_toggle2"  class="aEnfoncer"
                    style="display:inline;margin-left: 600px;  background-color: #ccc;  " >
                Utilisateurs
            </button> 
            <button  disabled="disabled" 
                     style="display:inline;  background-color: #ccc;  " >
                Audio
            </button> 
            <br><br>
            <?php
            //On cherche les audios
            $query = "SELECT * FROM audio WHERE titre LIKE '%' ? '%'";
            $sth = $dbh->prepare($query);
            $sth->execute(array($recherche));

            $i = 1;
            if ($rows = $sth->rowCount() == 0) {
                echo '<p id = "searchAudio" style="font-size:25px; margin-left : 200px; display:hidden">Il n\'y a pas de musique correspondant à votre recherche </p>';
            } else {
                while ($courant = $sth->fetch(PDO::FETCH_ASSOC)) {
                    $title = str_replace(" ", "_", $courant['titre']);
                    $music = "Audios/" . $courant['loginUser'] . $title . ".mp3";
                    printPlayer($i, $courant, $dbh);
                    $i = $i + 1;
                }
                ?><script  type="text/javascript">
                    $(document).ready(function () {
        <?php
        $sth = $dbh->prepare($query);
        $sth->execute(array($recherche));
        $i = 1;

        while ($courant = $sth->fetch(PDO::FETCH_ASSOC)) {
            $music = "Audios/" . $courant['loginUser'] . $title . ".mp3";
            //echo $music;
            ?>var myCirclePlayer<?php echo($i) ?> = new CirclePlayer("#jquery_jplayer_<?php echo($i) ?>",
                                {
                                    m4a: "<?php echo($music); ?>",
                                }, {
                            cssSelectorAncestor: "#cp_container_<?php echo($i) ?>",
                        });
            <?php
            $i = $i + 1;
        }
        ?>
                });
                </script><?php
    }
    echo '</div>';
    // }
    return true;
}
?>
