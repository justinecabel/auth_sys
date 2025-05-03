<?php
header('Content-Type: application/json');

require "auth.php";

echo json_encode(["success" => true]);