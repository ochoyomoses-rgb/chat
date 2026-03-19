<?php
require_once '../config/db.php';
// In a real app, verify admin session here
$stmt = $conn->prepare("SELECT first_name, last_name, email FROM users WHERE last_seen > NOW() - INTERVAL 5 MINUTE");
$stmt->execute();
echo json_encode(["online_now" => $stmt->fetchAll()]);
?>