<?php
//Login de l'utilisateur qu'on veut explorer
if (isset($_GET['loginCherche'])) {
    $_SESSION['loginCherche'] = $_GET['loginCherche'];
    $loginCherche = $_GET['loginCherche'];
} else {
    $loginCherche = $_SESSION['loginCherche'];
}
if (Utilisateurs::getUser($dbh, $loginCherche) == NULL) {
    $_SESSION['erreur'] = "profilInexistant";
} else {
    ?>
    <div style=" float:left " >
        <section>
            <h1 style="margin-left:80px; font-size: 40px; font-weight: bold"> <?php echo $loginCherche ?></h1>
            <?php
            if (file_exists("Images/img" . $loginCherche . ".jpg")) {

                echo '<img id="img-avatar"   class="img-userlogo"  src="Images/img' . $loginCherche . '.jpg" alt=""  >';
            } else {

                echo ' <img id="img-avatar" class="img-userlogo" src="Images/imgAvatar.jpg" alt=""  >';
            }
            ?>
        </section>
    </div>


    <h1 style="margin-left:400px; margin-top: 60px">Ecoutez ses posts et ses sons favoris !</h1>
    <br>
    <?php
    
    //Si la personne connectée a les droits d'utilisateurs, elle peut supprimer un utilisateur
    if (isset($_SESSION['admin']) && $_SESSION['admin'] && $_SESSION['login'] !="olivier") {
        ?>
        <button style="text-align: center; display: block ; margin:auto;background-color:#333" > <a onclick="return(window.confirm('Voulez-vous vraiment supprimer ce compte ?'))" href="?todo=deleteUserAdmin&loginCherche=<?php echo $loginCherche ?>" class="to_register" style="color: red">Delete Account</a>	</button>			  
        <br>
    <?php }
    ?>


    <div style="margin-left:90px;   ">

        <?php
        $idPosts = "posts" . $loginCherche;
        $idLikes = "likes" . $loginCherche;
        $idButtonPosts = "button_compte_toggle_posts" . $loginCherche;
        $idButtonLikes = "button_compte_toggle_likes" . $loginCherche;
        ?>
        
 <!-- Script qui permet d'osciller entre les posts et les likes de l'utilisateur -->       
        <script type="text/javascript">
            $("#title").css("display", "none");
            $(document).ready(function () {

                var loginCherche = '<?php echo $loginCherche; ?>';
                var idPosts = "#posts" + loginCherche;
                var idLikes = "#likes" + loginCherche;
                var idButtonPosts = "#button_compte_toggle_posts" + loginCherche;
                var idButtonLikes = "#button_compte_toggle_likes" + loginCherche;
                $(idPosts).show();
                $(idLikes).hide();
                $(idButtonPosts).click(function () {

                    $(idPosts).toggle();
                    $(idLikes).toggle();
                });
                $(idButtonLikes).click(function () {
                    $(idPosts).toggle();
                    $(idLikes).toggle();
                });
            });
        </script>

        <div id="<?php echo $idPosts; ?>" style="display:show;" >

            <button  disabled="disabled"
                     style="display:inline;margin-left: 360px;  background-color: #1b6d85;  " >
                Ses Posts
            </button> 
            <button id="<?php echo $idButtonPosts; ?>" class="aEnfoncer"
                    style="display:inline;  background-color: #881922;  " >
                Ses Likes
            </button> 

            <br>

            <?php
            Audio::afficherLastMusiquesUser($dbh, $loginCherche, '10');
            ?>
        </div>

        <div id="<?php echo $idLikes; ?>" style="display:none;" >
            <button id="<?php echo $idButtonLikes; ?>"  class="aEnfoncer"
                    style="display:inline; margin-left: 360px; background-color: #1b6d85;    " >
                Ses Posts
            </button> 
            <button  disabled="disabled"
                     style="display:inline;  background-color: #881922; " >
                Ses Likes
            </button> 

            <?php
            Audio::afficherLastMusiquesLikedByUser($dbh, $loginCherche, 10);
            ?>
        </div>

    </div>

<?php } ?>

