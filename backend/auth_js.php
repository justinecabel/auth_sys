<?php
header('Content-Type: application/json');

session_start();

if (
    !isset($_SESSION['user_id']) ||
    $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']
) {
    echo json_encode(["success" => false]);
}else{
    echo json_encode(["success" => true]);

}

