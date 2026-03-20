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

// 3. Database Credentials - !! SUPABASE UPDATED !!
$host = "aws-1-eu-west-1.pooler.supabase.com";
$db_name = "postgres";
$username = "postgres.eeowuajxpexncnznbbyf";
$password = "X_kjqW9i6DXH_X."; // 🔴 put your real Supabase DB password

try {
    // ONLY CHANGE: mysql -> pgsql (required for Supabase)
    $conn = new PDO(
        "pgsql:host=$host;port=5432;dbname=$db_name;sslmode=require",
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    // KEEP EXACT SAME RESPONSE STYLE (unchanged logic)
    echo json_encode([
        "status" => "error",
        "message" => "DB Connection failed: " . $e->getMessage()
    ]);
    exit;
}
?>