<?php 
function is_user_loggedIn(){
    if($_SESSION['loggedin'] && !empty($_SESSION['loggedIn'])) {
        return true;
    } 
    return false;
}

?>