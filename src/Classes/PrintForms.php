<?php

//Affiche le formulaire de connexion/inscription
function printLoginForm($askedPage) {
    ?>
    <div id="container_demo" >
        <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
        <div id="wrapper">
            <!-- formulaire pour se connecter -->
            <div id="login" class="animate form">
                <form  action="index.php?todo=login&name=<?php echo $_SESSION["namePrec"] ?>" autocomplete="on" method="post"> 
                    <h1>Log in</h1> 
                    <p> 
                        <label for="username" class="uname" data-icon="u" > Your email or username </label>
                        <input id="username" name="loginConnexion" required="required" autofocus type="text" placeholder="my username"/>
                    </p>
                    <p> 
                        <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                        <input id="password" name="mdpConnexion" required="required" type="password" placeholder="my secret password" /> 
                    </p>
            <!--	<p class="keeplogin"> 
                            <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
                            <label for="loginkeeping">Keep me logged in</label>
                    </p>    -->
                    <p class="login button"> 
                        <input type="submit" value="Login" /> 
                    </p>
                    
            <!-- Bouton qui permet de passer au formulaire d'inscription -->                    
                    <p class="change_link">
                        Not a member yet ?
                        <a href="#toregister" class="to_register">Join us</a>
                    </p>
                </form>
            </div>
            <!-- formulaire pour s'inscrire -->
            <div id="register" class="animate form">
                <form  action="?todo=register&name=<?php echo$askedPage ?>" autocomplete="on" method="post"> 
                    <h1> Sign up </h1> 
                    <p> 
                        <label for="usernamesignup" class="uname" data-icon="u" >Your username</label>
                        <input id="usernamesignup" name="login" required="required" type="text"  placeholder="mysuperusername690" />
                    </p>

                    <p> 
                        <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                        <input id="passwordsignup" name="password1" required="required" type="password" placeholder="eg. X8df!90EO"/>
                    </p>
                    <p> 
                        <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                        <input id="passwordsignup_confirm" name="password2" required="required" type="password" placeholder="eg. X8df!90EO"/>
                    </p>
                    <p> 
                        <label for="prenom"  data-icon="u">Prenom</label>
                        <input id="prenom" name="prenom" required="required" type="text" placeholder="Prenom" />
                    </p>
                    <p> 
                        <label for="nom" data-icon="u">Nom</label>
                        <input id="nom" name="nom" required="required" type="text" placeholder="Nom" />
                    </p>
                    <p> 
                        <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
                        <input id="emailsignup" name="email" required="required" type="email" placeholder="mysupermail@mail.com"/> 
                    </p>
                    <p class="signin button"> 
                        <input type="submit" value="Sign up"/> 
                    </p>
                    <p class="change_link">  
                        Already a member ?
                        <a href="#tologin" class="to_register"> Go and log in </a>
                    </p>
                </form>
            </div>

        </div>
    </div>  



<?php } ?>
