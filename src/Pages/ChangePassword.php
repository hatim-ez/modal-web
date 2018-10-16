<?php require("MonCompte.php"); ?>



<div id="container_demo" >
    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
    <a class="hiddenanchor" id="toregister"></a>
    <div id="wrapper">

        <div id="register" class="animate form">
            <form action="index.php?todo=changemdp" method="post">  
                <h1> Modification de votre Mot de Passe </h1> 
                <p> 
                    <label for="ancienMdp"  data-icon="p">Ancien mot de passe</label>
                    <input type="password" name="ancienMdp" placeholder="Last password " required>
                </p>
                <p> 
                    <label for="newMdp" data-icon="p">Nouveau mot de passe</label>
                    <input type="password" name="newMdp" placeholder="New password" required>
                </p>
                <p> 
                    <label for="newMdpBis" class="youmail" data-icon="p" > Confirmer votre nouveau mot de passe</label>
                    <input type="password" name="newMdpBis" placeholder="Confirm new password" required>
                </p>

                <p class="login button"> 
                    <input type="submit" value="Confirmer" /> 
                </p>

            </form>	

        </div>

    </div>
</div> 

