<!-- Ce fichier correspond au domaine de gauche dans les pages de Mon Compte -->

<div style=" float:left " >
    <section>
        <?php
        if ($_SESSION['loggedIn'] = true) {
            $login = Utilisateurs::getLoginUtilisateur(Database::connect(), $_SESSION['login']);
            if (file_exists("Images/img" . $login . ".jpg")) {

                echo '<img id="img-avatar"   class="img-userlogo"  src="Images/img' . $login . '.jpg" alt=""  >';
            } else
                echo ' <img id="img-avatar" class="img-userlogo" src="Images/imgAvatar.jpg" alt=""  >';
        }
        ?>
    </section>
    <!-- Upload d'image d'avatar -->
    <form action="index.php?todo=uploadimgavatar " method="post" enctype="multipart/form-data" >
        <input type="file" name="fichier" style="margin-left: 50px"
               />
        <br>
        <input type="submit" class=" btn icon--single icon-upload" style="margin-left: 70px" value="Upload" />
    </form>
    
    <br>
    <br>
    <!-- Lien vers les onglets de Mon Compte -->
    <ul style="margin-left : 50px; list-style-type: square"> 
        <li  > <a href="?name=MonCompteInformation#toregister">Informations</a> </li>
        <li> <a href="?name=MonCompteMusique">Musique</a> </li>
    </ul>

</div>






