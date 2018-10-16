<?php require("MonCompte.php");
?>


<h1>Il vous suffit de remplir le formulaire suivant et de le valider.</h1>
<br> 
<!-- Formulaire qui permet d'uploader un son -->
<form method='post' action='index.php?todo=uploadson' enctype='multipart/form-data'>
    <div id="container_demo" >
        <a class="hiddenanchor" id="toregister"></a>
        <div id="wrapper">


            <div id="register" class="animate form" style ="margin-left: 100px">
                <h1> Upload </h1> 
                <p> 
                    <label for="titleSong"   >Titre</label>
                    <input id="titleSong" name="titleSong" required="required" type="text"   />
                </p>


                <p> 
                    <label for="artiste" data-icon="u">Artiste </label>
                    <input id="artiste" name="artiste"  type="text" />
                </p>
                <p> 
                    <label for="album"  >Album </label>
                    <input id="album" name="album" type="text" />
                </p>
                <p> 
                    <label for="anneePublication"  >Année de publication</label>
                    <input id="anneePublication" name="anneePublication"  type="text"  />
                </p>
                <p> 
                    <label for="genre" >Genre</label>
                    <select id="genre" name="genre">
                        <option value="pop">Pop</option>
                        <option value="variete">Variété</option>
                        <option value="metal">Metal</option>
                        <option value="reggae">Reggae</option>
                        <option value="country">Country</option>
                        <option value="jazz">Jazz</option>
                        <option value="rock">Rock</option>
                        <option value="hiphop">Hip-Hop</option>
                        <option value="rnb">R&B</option>
                        <option value="electro">Electro</option>
                        <option value="funk">Funk</option>
                        <option value="classique">Classique</option>

                    </select> 
                </p>

                <p> 
                    <label for="description"  > Description  </label>
                    <input id="description" name="description" type="text" placeholder="Si vous avez un commentaire à faire .."/> 
                </p>
                <input type="file" name="fichier" required />

                <p class="signin button"> 
                    <input type="submit" value="Envoyer !"/> 
                </p>


            </div>

        </div>
    </div>  
</form>

