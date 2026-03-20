<?php
// 1. Headers for Flutter/Android compatibility
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once '../config/db.php';

// 2. Get the JSON data from the Flutter app
$data = json_decode(file_get_contents("php://input"));

// Check for all required fields
if(!empty($data->sender_id) && !empty($data->receiver_id) && !empty($data->message)) {
    
    try {
      // Change the RETURNING line to match your DB column
$query = 'INSERT INTO "messages" (sender_id, receiver_id, message_text) 
          VALUES (?, ?, ?) 
          RETURNING id, created_at';
        
        $stmt = $conn->prepare($query);
        $stmt->execute([$data->sender_id, $data->receiver_id, $data->message]);
        
        // Fetch the returned row
        $newMessage = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "success",
            "message_id" => $newMessage['id'],
            "timestamp" => $newMessage['timestamp']
        ]);

    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([
            "status" => "error",
            "message" => "Database error: " . $e->getMessage()
        ]);
    }
} else {
    http_response_code(400);
    echo json_encode([
        "status" => "error", 
        "message" => "Incomplete data. Need sender_id, receiver_id, and message."
    ]);
}
?>
