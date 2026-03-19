<?php
require_once '../config/db.php';

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->email) && !empty($data->password)) {
        $email = $data->email;
        $password = $data->password;

        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        // Verify password (Assuming you used password_hash in register.php)
        if ($user && password_verify($password, $user['password'])) {
            echo json_encode([
                "status" => "success",
                "message" => "Login successful",
                "user" => [
                    "id" => $user['id'],
                    "first_name" => $user['first_name'],
                    "last_name" => $user['last_name'],
                    "email" => $user['email']
                ]
            ]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid email or password"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Incomplete data"]);
    }
} else {
    // This prevents the blank page when visiting in a browser
    echo json_encode([
        "status" => "info", 
        "message" => "Login endpoint is active. Please send a POST request."
    ]);
}
?>