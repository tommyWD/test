<?php
function token(){
    session_start();
    $options = [
        'cost' => 4,
    ];
    $hash = name(10);
    $_SESSION['hash'] = $hash;
    $token = password_hash($hash,  PASSWORD_BCRYPT, $options);
    return $token;
    session_write_close();
}
function name($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>