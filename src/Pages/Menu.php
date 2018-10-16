
<nav class="navbar navbar-inverse " >
    <div class="container-fluid">


        <ul class="nav navbar-nav ">
            <li> <div><a href="index.php"></a> <img src="Images/Logo.jpg" width="70" height="50" alt="logo" /></div></li>
            <li> <a href="index.php?name=Accueil">Accueil</a> </li>
            <li> <a href="index.php?name=Stream">Stream</a> </li>
            <li> <a href="index.php?name=Parcourir">Parcourir</a> </li>
            <li> <form class="navbar-form navbar-right inline-form" method="post" action="index.php?name=Search&todo=search">
                    <div class="form-group ">
                        <input type="search" name="search" class="input-sm form-control" placeholder="Recherche" >
                        <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open"></span> Chercher</button>

                    </div>
                </form>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">


            <?php
            
            //Si la personne est connectée, on affiche les onglets "Mon Compte" et "Déconnexion" sinon on invite la personne à s'enregistrer
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {

                echo'<li><a  href="index.php?name=MonCompteMusique">Mon Compte</a></li>';
                echo'
                            <li><a  href="?todo=logout" >Déconnexion</a></li>';
            } else {
                if (isset($_GET['name']) && $_GET['name'] !== "SeConnecter") {
                    $_SESSION['namePrec'] = $_GET['name'];
                }
                echo "<li class = 'activebis signin'><a href='index.php?name=SeConnecter'>Se Connecter / S'inscrire</a></li>";

                
            }
            echo '</ul> </div> </nav>';
            ?>                   
            <div class ="col-md-1"></div>

