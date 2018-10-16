<?php require("MonCompte.php");
?>


<h1 style="text-align: center; margin-top: 60px">Ecoutez vos posts et vos sons favoris, ou alors ajoutez-en !</h1>
<br>
<button class="btn btn-primary" style="display:block; text-align: center ; margin : auto"> <a href="?name=MonCompteUploadSon#toregister" class="to_register">Upload</a>	</button>
<br><br>

<div style="margin-left:90px;   ">
    <!-- script qui permet d'osciller entre posts et likes  -->
    <script type="text/javascript">
        $(document).ready(function () {
            $("#mesPosts").show();
            $("#mesLikes").hide();
            $("#button_compte_toggle").click(function () {

                $("#mesPosts").toggle();
                $("#mesLikes").toggle();
            });
            $("#button_compte_toggle2").click(function () {

                $("#mesPosts").toggle();
                $("#mesLikes").toggle();
            });
        });
    </script>
    
<!-- Mes Posts -->
    <div id="mesPosts" style="display:show;" >

        <button  disabled="disabled"
                 style="display:inline;margin-left: 360px;  background-color: #1b6d85;  " >
            Mes Posts
        </button> 
        <button id="button_compte_toggle" class="aEnfoncer"
                style="display:inline;  background-color: #881922;  " >
            Mes Likes
        </button> 

        <br>

        <?php
        Audio::afficherLastMusiquesUser($dbh, $_SESSION['login'], '10');
        ?>
    </div>

<!-- Mes Likes -->
    <div id="mesLikes" style="display:none;" >
        <button id="button_compte_toggle2"  class="aEnfoncer"
                style="display:inline; margin-left: 360px; background-color: #1b6d85;    " >
            Mes Posts
        </button> 
        <button  disabled="disabled"
                 style="display:inline;  background-color: #881922; " >
            Mes Likes
        </button> 

        <?php
        Audio::afficherLastMusiquesLikedByUser($dbh, $_SESSION['login'], 10);
        ?>
    </div>

</div>
