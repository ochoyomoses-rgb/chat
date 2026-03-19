<?php
require_once '../config/db.php';
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->user_id)) {
    $stmt = $conn->prepare("UPDATE users SET last_seen = NOW() WHERE id = ?");
    $stmt->execute([$data->user_id]);
    echo json_encode(["status" => "success"]);
}
?>