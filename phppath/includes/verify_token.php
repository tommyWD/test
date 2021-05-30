<?php
function passwordVerify($password,$hash){
    if (password_verify($password, $hash)) {
        $link = true;
    } else {
        $link = false;
    }
    return $link;
}
?>