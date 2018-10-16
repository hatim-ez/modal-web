<?php
//Si l'internaute entre un texte dans la barre de recherche :
if (isset($_POST['search'])) {

    search($dbh, $_POST['search']);
}
