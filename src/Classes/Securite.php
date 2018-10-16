<?php

// Traite le texte, évite que l'utilisateur rentre des caractères trop exotiques 

function checkTxt($txt) {
    if (preg_match("/^[-a-z0-9._ \x7f-\xff'\(\)\,\+\"\&\`\/\[\]]{0,512}$/i", $txt) === 0) {
        return false;
    }
    return true;
}
