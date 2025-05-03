<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
$text = $data['input'] ?? '';

echo json_encode(["result" => password_hash($text, PASSWORD_DEFAULT)]);