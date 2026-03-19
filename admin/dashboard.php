<?php
require_once '../config/db.php';

// Total Users Count
$userCount = $conn->query("SELECT COUNT(id) as total FROM users")->fetch()['total'];

// Total Messages Sent
$msgCount = $conn->query("SELECT COUNT(id) as total FROM messages")->fetch()['total'];

// Users online in the last 5 minutes
$onlineCount = $conn->query("SELECT COUNT(id) as total FROM users WHERE last_seen > NOW() - INTERVAL 5 MINUTE")->fetch()['total'];

echo json_encode([
    "status" => "success",
    "stats" => [
        "total_users" => $userCount,
        "total_messages" => $msgCount,
        "online_users" => $onlineCount
    ]
]);
?>