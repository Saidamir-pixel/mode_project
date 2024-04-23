<?php
include "db.php";
include "user.php";

function reg(){
    $auth = user_reg();
    return $auth;
}

function login() {
    $login = user_login();
    return $login;
}

function lastWord() {
    $lastWord = saveTimerTime();
    return $lastWord;
}
 
function timerData() {
    $timerData = getData();
    return $timerData;
}