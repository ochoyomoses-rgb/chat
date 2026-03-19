<?php
require_once '../config/db.php';

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->email) && !empty($data->password)) {
    // Check if user exists and is an admin
    $query = "SELECT * FROM users WHERE email = ? AND is_admin = 1";
    $stmt = $conn->prepare($query);
    $stmt->execute([$data->email]);
    $admin = $stmt->fetch();

    if($admin && password_verify($data->password, $admin['password'])) {
        unset($admin['password']); // Safety first
        echo json_encode([
            "status" => "success", 
            "message" => "Admin authenticated", 
            "admin_data" => $admin
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Unauthorized access or invalid credentials"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Email and password required"]);
}
?>