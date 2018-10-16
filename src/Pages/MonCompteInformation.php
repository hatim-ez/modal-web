<?php 
//On affiche la colonne de gauche, avec entre autre l'image d'avatar etc ..
require("MonCompte.php");
?>

<!-- On affiche les informations du compte -->
<div id="container_demo" >
    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
    <a class="hiddenanchor" id="toregister"></a>
    <div id="wrapper">

        <div id="register" class="animate form">

            <h1> Account </h1> 

            <label  class="uname" data-icon="u">Your login</label>
            <p style="text-align:center" > <?php echo $_SESSION['login'] ?> </p>




            <label   data-icon="u">Prenom</label>
            <p style="text-align:center" > <?php echo $_SESSION['prenom'] ?> </p>


            <label  data-icon="u">Nom</label>
            <p style="text-align:center" > <?php echo $_SESSION['nom'] ?> </p>				


            <label  class="youmail" data-icon="e" > Your email</label>
            <p style="text-align:center" > <?php echo $_SESSION['email'] ?> </p> 


            <button style="text-align: center; display: block ; margin:auto"> <a href="?name=ChangePassword#toregister" class="to_register">Change Password</a>	</button>			  
            <button style="text-align: center; display: block ; margin:auto;" > <a onclick="return(window.confirm('Voulez-vous vraiment supprimer votre compte ?'))" href="?name=DeleteUser&todo=deleteUser" class="to_register" style="color: red">Delete Account</a>	</button>			  



        </div>

    </div>
</div> 




