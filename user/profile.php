<?php
require_once '../config/db.php';
$data = json_decode(file_get_contents("php://input"));

// GET PROFILE
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_id'])) {
    $stmt = $conn->prepare("SELECT id, first_name, last_name, email, created_at FROM users WHERE id = ?");
    $stmt->execute([$_GET['user_id']]);
    $user = $stmt->fetch();
    echo json_encode($user ? $user : ["status" => "error", "message" => "User not found"]);
} 

// UPDATE PROFILE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($data->user_id)) {
    $query = "UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    
    if($stmt->execute([$data->first_name, $data->last_name, $data->email, $data->user_id])) {
        echo json_encode(["status" => "success", "message" => "Profile updated"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Update failed"]);
    }
}
?>