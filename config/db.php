<?php
// 1. Set headers for JSON and CORS
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// 2. Handle preflight request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 3. Supabase PostgreSQL credentials
$host = "aws-1-eu-west-1.pooler.supabase.com";
$db_name = "postgres";
$username = "postgres.eeowuajxpexncnznbbyf";
$password = "Az568253@"; // ⚠️ put your real password here
$port = "5432";

try {
    $conn = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db_name;sslmode=require",
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Test connection (you can remove later)
    echo json_encode([
        "status" => "success",
        "message" => "Connected to Supabase DB"
    ]);

} catch(PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "DB Connection failed: " . $e->getMessage()
    ]);
    exit;
}
?>
