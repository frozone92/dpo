<?php

function isAuthorized(){
    return isset($_SESSION['auth_user']);
}

function authUser(){
    return $_SESSION['auth_user'];
}
