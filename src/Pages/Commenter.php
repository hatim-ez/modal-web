<?php
Commentaires::insererCommentaire($dbh, $_SESSION['login'], getdate(), $_POST['comment'], 32);
?>

