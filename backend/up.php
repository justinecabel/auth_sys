<?php
header("Content-Type: application/json");

try {
    require_once "connection.php";
    $status_db = "ok";
} catch (PDOException $e) {
    $status_db = "error";
}

// Get MySQL version and uptime
$mySQL_version = $pdo->getAttribute(PDO::ATTR_SERVER_VERSION);
$mySQL_uptime = $pdo->query("SHOW GLOBAL STATUS LIKE 'Uptime'")->fetch(PDO::FETCH_ASSOC);
$mySQL_uptime = $mySQL_uptime['Value'];
//parsing uptime to xhxm
$hours = floor($mySQL_uptime / 3600);
$minutes = floor(($mySQL_uptime % 3600) / 60);
$mySQL_uptime = sprintf("%02dh%02dm", $hours, $minutes);

// Get server hostname
$stmt = $pdo->query("SELECT @@hostname AS host");
$host = $stmt->fetchColumn();
// Try to resolve hostname to IP
$ip = gethostbyname($host);

//result
echo json_encode(
    [
        "status_php" => phpversion(),
        "status_db" => $status_db." (ver: ".$mySQL_version." | uptime: ".$mySQL_uptime.")",
        "db_ip" => $ip
    ]);