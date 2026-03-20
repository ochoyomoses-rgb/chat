<?php
// 1. Add headers so Flutter doesn't block the response
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config/db.php';

// 2. Check if IDs exist to avoid PHP warnings
$s_id = isset($_GET['sender_id']) ? $_GET['sender_id'] : null;
$r_id = isset($_GET['receiver_id']) ? $_GET['receiver_id'] : null;

if (!$s_id || !$r_id) {
    echo json_encode(["status" => "error", "message" => "Missing IDs"]);
    exit;
}

try {
    // 3. Use double quotes for "timestamp" as it is a reserved word in Postgres
   // Change the ORDER BY line to match your DB column
$query = 'SELECT * FROM "messages" 
          WHERE (sender_id = ? AND receiver_id = ?) 
          OR (sender_id = ? AND receiver_id = ?) 
          ORDER BY created_at ASC';
              
    $stmt = $conn->prepare($query);
    $stmt->execute([$s_id, $r_id, $r_id, $s_id]);
    
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($messages);

} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Query failed: " . $e->getMessage()
    ]);
}
?>
