<?php
//$courant correspon à la l'élement audio qu'on récupère de la table 'audio'
function printPlayer($i, $courant, $dbh) {
    ?>
    <!-- The jPlayer div must not be hidden. Keep it at the root of the body element to avoid any such problems. -->
    <div id="jquery_jplayer_<?php echo($i) ?>" class="cp-jplayer" style="width: 0px; height: 0px;"></div>

    <!-- The container for the interface can go where you want to display it. Show and hide it as you need. -->
    <div class="col-md-11">
        <!-- Permet d'afficher le fichier audio dans un rectangle -->
        <div class="well sidebar-nav" style="background-color:inherit;border-color:silver; margin-left: 120px; border-width: 3px;" >
            <div class="row">
                <!-- Permet d'afficher le titre et l'artiste -->
                <div class="col-md-5">
                    <h1 style="color:silver;"><?php echo($courant['titre']) ?></h1>
                    <h1 style="color:inherit; font-size:25px;"><?php echo($courant['artiste']) ?></h1>
                </div>
                <div class="col-md-6">
                    <?php
                    //Ce qui suit permet d'afficher des informations sur la personne qui a posté la chanson lorsqu'on passe la souris sur son login
                    if (file_exists("Images/img" . $courant['loginUser'] . ".jpg")) {
                        $img = "Images/img" . $courant['loginUser'] . ".jpg";
                    } else {
                        $img = "Images/imgAvatar.jpg";
                    }
                    ?>



                    <p style="color:silver;font-size:20px;text-align:right;"> Posté par <a data-toggle="tooltipimg" title=
                                                                                           "<p style='font-size:25px'> <?php echo $courant['loginUser'] ?></p>
                                                                                           <img src='<?php echo $img ?>' width='160' height='160'/>
                                                                                           <p style='margin-top:10px'><?php echo Audio::nbPostsParLogin($dbh, $courant['loginUser']) ?> sons postés </p>
                                                                                           <p><?php echo Commentaires::nbCommParLogin($dbh, $courant['loginUser']) ?> commentaires </p>
                                                                                           " href="?name=PageUtilisateur&loginCherche=<?php echo( $courant['loginUser']) ?>"><?php echo( $courant['loginUser']) ?></a> </p>
                    <a href="?name=ParcourirGenres/<?php echo($courant['genre']) ?>" >
                        <p style="color:inherit;font-size:20px;text-align:right;"> <?php echo('#' . $courant['genre']) ?> </p>
                    </a>
                </div>
            </div>
            <div class="row" style="height:20px"></div>
            <div class="row">
                <div class="col-md-1">
                    <div class="row" style="height:50px"></div>

                    <div class="row">
                        <?php
                        if (isset($_SESSION['login'])) {
                            $login = $_SESSION['login'];
                            $query = "SELECT * FROM `jaime` WHERE `id` = ? AND `login` = ?";
                            $sth = $dbh->prepare($query);
                            $request_succeeded = $sth->execute(array($courant['id'], $login));
                            $rows = $sth->rowCount();
                            if ($rows == 0) {
                                $todo = "jaime";
                                $color = "inherit";
                            } else {
                                $todo = "annulerjaime";
                                $color = "#990017";
                            }
                        }
                        ?>
                        <a data-toggle="tooltip" title="J'aime" style="float: right;" class="btn btn-default" <?php if (isset($_SESSION['login'])) {
                        echo 'href="index.php?name=' . $_GET['name'] . '&todo=' . $todo . '&id=' . $courant['id'] . '"';
                    } ?>>
                            <?php
                            $query = "SELECT * FROM `jaime` WHERE `id` = " . $courant['id'];
                            $sth = $dbh->prepare($query);
                            $request_succeeded = $sth->execute();
                            $rows = $sth->rowCount();
                            echo($rows);
                            ?>
                            <span class="glyphicon glyphicon-heart" aria-hidden="true" style="color:<?php echo $color ?>"></span>
                        </a>
                    </div>
                    <div class="row" style="height:40px"></div>
                    <div class="row">
                        <span class="pull-right" data-toggle="tooltip" title="Commenter" >
                            <button type="button" class="btn btn-default" style="float: right;"  <?php if (isset($_SESSION['login'])) {
                                echo 'data-toggle="modal" data-target="#myModal' . $courant['id'] . '"';
                            } ?> >
                                <?php
                                $query = "SELECT * FROM `commentaires` WHERE `idmusic` = " . $courant['id'];
                                $sth = $dbh->prepare($query);
                                $request_succeeded = $sth->execute();
                                $rows = $sth->rowCount();
                                echo($rows);
                                if (isset($_SESSION['login'])) {
                                    $query = "SELECT * FROM `commentaires` WHERE `idmusic` = ? AND `login` = ?";
                                    $sth = $dbh->prepare($query);
                                    $request_succeeded = $sth->execute(array($courant['id'], $login));
                                    $rows = $sth->rowCount();
                                    if ($rows > 0) {
                                        $color = "#076cab";
                                    } else {
                                        $color = "inherit";
                                    }
                                }
                                ?>
                                <span class="glyphicon glyphicon-comment" aria-hidden="true" style="color:<?php echo $color ?>"></span>
                            </button>
                        </span>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal<?php echo $courant['id'] ?>" role="dialog">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <form method="post" action="index.php?name=<?php echo $_GET['name'] ?>&id=<?php echo $courant['id'] ?>&todo=commenter" enctype='multipart/form-data'>




                                        <div class="modal-body">

                                            <div class="form-group">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <label class="form-control-label">Commentaire:</label>
                                                <textarea placeholder="Rédigez votre commentaire..." class="form-control" name="comment" id="comment<?php echo $courant['id'] ?>" required="required" rows="5"></textarea>                                                        
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <input type="submit" class="btn btn-primary"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="media testimonial">
                        <div id="cp_container_<?php echo($i) ?>" class="cp-container">
                            <div class="cp-buffer-holder">
                                <div class="cp-buffer-1"></div>
                                <div class="cp-buffer-2"></div>
                            </div>
                            <div class="cp-progress-holder">
                                <div class="cp-progress-1"></div>
                                <div class="cp-progress-2"></div>
                            </div>
                            <div class="cp-circle-control"></div>
                            <ul class="cp-controls">
                                <li><a class="cp-play" tabindex="1">play</a></li>
                                <li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row" style="height:5px"></div>
                    <div class="well sidebar-nav" style="background-color:#141414;border-color:silver;" >
                        <div class="nav" style="overflow-y:auto;overflow-x: hidden;height: 145px;">
    <?php Commentaires::afficherCommentaires($dbh, $courant['id']); ?>
                        </div>
                    </div>
    <?php 
    //On permet à l'internaute de changer le genre de la musique ou de la supprimer si c'est un admin ou si c'est lui qui l'a postée   
    if (isset($_SESSION['admin']) && ( $_SESSION['admin'] || $_SESSION['login'] == $courant['loginUser'])) { ?>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-3"> <button style="background-color:#333" > <a onclick = 'return(window.confirm("Voulez-vous vraiment supprimer cette chanson ?"))' href="?name=<?php echo $_GET['name'] ?>&todo=deleteAudio&idAudio=<?php echo $courant['id'] ?>" class="to_register" style="color: red; font-size:15px">Delete File</a>	</button> <br>	  
                            </div>
                            <div class="col-md-8" >
                                <form method='post' action='index.php?name=<?php echo $_GET['name'] ?>&todo=changeTagAudioAdmin&idAudio=<?php echo $courant['id'] ?>' >
                                    <div class="col-md-4">
                                        <label  >Changer le genre</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select  name="genreAdmin">
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
                                    </div>
                                    <div class="col-md-4">
                                        <input type="submit" value="Changer"/> 
                                    </div>
                                </form>

                            </div>

                        </div>
    <?php } ?>
                </div>
            </div> 
        </div> 
        <div class="row" style="height:60px"></div>
    </div> 



    <script>
        $(document).ready(function () {
            $('a[data-toggle="tooltipimg"]').tooltip({
                animated: 'fade',
                placement: 'right',
                html: true
            });
            $('[data-toggle="tooltip"]').tooltip({container: 'body'});
        });
    </script>
    <?php
}
?>