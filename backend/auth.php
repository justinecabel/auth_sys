<?php

session_start();

function auth_success(){
    if (
        !isset($_SESSION['user_id']) ||
        $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']
    ) {
        return false;
    }else{
        return true;
    
    }
}

if (!auth_success()){
    echo json_encode(["success" => false, "message" => "Action Not Permitted"]);
    exit;
}