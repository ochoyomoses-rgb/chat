<?php
// ===============================
// DB CONFIG (SUPABASE POSTGRES)
// ===============================

// 1. Connection details (FROM YOUR SUPABASE PROJECT)
$host = "aws-1-eu-west-1.pooler.supabase.com";
$port = "5432";
$db_name = "postgres";

// IMPORTANT: Supabase username format
$username = "postgres.eeowuajxpexncnznbbyf";

// ⚠️ PUT YOUR REAL PASSWORD HERE
$password = "X_kjqW9i6DXH_X.";

// ===============================
// PDO CONNECTION
// ===============================

try {
    $conn = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db_name;sslmode=require",
        $username,
        $password
    );

    // Make PDO throw errors properly
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Return associative arrays
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    // IMPORTANT: return ONLY ONE clean JSON response
    echo json_encode([
        "status" => "error",
        "message" => "DB Connection failed"
    ]);
    exit;
}
?>