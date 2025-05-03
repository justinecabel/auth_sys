<?php
header("Content-Type: application/json");

include "connection.php";



$data = json_decode(file_get_contents("php://input"), true);

$user = $data['user'] ?? '';
$password = $data['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM users WHERE BINARY user = ?");
$stmt->execute([$user]);
$res= $stmt->fetch();

if ($res && password_verify($password, $res['pass_hash'])) {
  session_start();
  $_SESSION['user_id'] = $res['user'];
  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
  echo json_encode(["success" => true]);
} else {
  echo json_encode(["success" => false, "message" => "Invalid credentials"]);
}
