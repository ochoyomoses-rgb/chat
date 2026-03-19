<?php
// 1. Set headers for JSON and Cross-Origin Resource Sharing (CORS)
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// 2. Handle the 'Pre-flight' OPTIONS request (Android/iOS send this first)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 3. Database Credentials - !! DOUBLE CHECK THESE !!
$host = "sql203.infinityfree.com";
$db_name = "if0_38869899_letuxchat"; // Change to your live DB name
$username = "if0_38869899"; // Change to your live DB user
$password = "5Qra0PPE4GVdzd"; // Change to your live DB password

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // Return the actual error so you can see it in the app if it fails
    echo json_encode(["status" => "error", "message" => "DB Connection failed: " . $e->getMessage()]);
    exit;
}
?>
