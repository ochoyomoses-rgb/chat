<?php
require_once '../config/db.php';

$stmt = $conn->prepare("SELECT id, first_name, last_name, email, 
                       (CASE WHEN last_seen > NOW() - INTERVAL 1 MINUTE THEN 'online' ELSE 'offline' END) AS status 
                       FROM users");
$stmt->execute();
echo json_encode($stmt->fetchAll());
?>
