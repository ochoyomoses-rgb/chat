<?php

$request = trim($_SERVER['REQUEST_URI'], '/');
$method = $_SERVER['REQUEST_METHOD'];

// Remove query strings
$request = explode('?', $request)[0];

// ROUTING

if ($request === 'api/fetch_users') {
    require __DIR__ . '/api/fetch_users.php';
    exit;
}

if ($request === 'api/get_messages') {
    require __DIR__ . '/api/get_messages.php';
    exit;
}

if ($request === 'api/send_messages' && $method === 'POST') {
    require __DIR__ . '/api/send_messages.php';
    exit;
}

// USER ROUTES
if ($request === 'user/login') {
    require __DIR__ . '/user/login.php';
    exit;
}

if ($request === 'user/register') {
    require __DIR__ . '/user/register.php';
    exit;
}

if ($request === 'user/status') {
    require __DIR__ . '/user/status.php';
    exit;
}

if ($request === 'user/profile') {
    require __DIR__ . '/user/profile.php';
    exit;
}

// ADMIN ROUTES
if ($request === 'admin/login') {
    require __DIR__ . '/admin/login.php';
    exit;
}

if ($request === 'admin/dashboard') {
    require __DIR__ . '/admin/dashboard.php';
    exit;
}

if ($request === 'admin/active_users') {
    require __DIR__ . '/admin/active_users.php';
    exit;
}

// DEFAULT 404
http_response_code(404);
echo json_encode([
    "status" => "error",
    "message" => "Route not found"
]);