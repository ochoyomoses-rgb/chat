<?php
require_once '../config/db.php';
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->sender_id) && !empty($data->receiver_id) && !empty($data->message)) {
    $query = "INSERT INTO messages (sender_id, receiver_id, message_text) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$data->sender_id, $data->receiver_id, $data->message]);
    echo json_encode(["status" => "success"]);
}
?>