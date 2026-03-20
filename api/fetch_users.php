<?php
require_once '../config/db.php';

try {
    // Postgres specific syntax for time intervals
    $sql = "SELECT id, first_name, last_name, email, 
            (CASE WHEN last_seen > NOW() - INTERVAL '1 minute' THEN 'online' ELSE 'offline' END) AS status 
            FROM users";
            
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // FETCH_ASSOC ensures you don't get duplicate numeric keys in your JSON
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($users);

} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Query failed: " . $e->getMessage()
    ]);
}
?>
