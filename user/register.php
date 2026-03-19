<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->first_name) && !empty($data->last_name) && !empty($data->email) && !empty($data->password)) {
        
        $password_hash = password_hash($data->password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (first_name, last_name, email, password) VALUES (:fn, :ln, :em, :pw)";
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(':fn', $data->first_name);
        $stmt->bindParam(':ln', $data->last_name);
        $stmt->bindParam(':em', $data->email);
        $stmt->bindParam(':pw', $password_hash);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "User registered successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Registration failed"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Incomplete data"]);
    }
} else {
    echo json_encode(["status" => "info", "message" => "Registration endpoint is active."]);
}
?>