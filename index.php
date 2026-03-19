<?php

$request = trim($_SERVER['REQUEST_URI'], '/');
$request = explode('?', $request)[0];

switch ($request) {

    // USER
    case 'user/login':
        require __DIR__ . '/user/login.php';
        break;

    case 'user/register':
        require __DIR__ . '/user/register.php';
        break;

    case 'user/status':
        require __DIR__ . '/user/status.php';
        break;

    case 'user/profile':
        require __DIR__ . '/user/profile.php';
        break;

    // API
    case 'api/fetch_users':
        require __DIR__ . '/api/fetch_users.php';
        break;

    case 'api/get_messages':
        require __DIR__ . '/api/get_messages.php';
        break;

    case 'api/send_messages':
        require __DIR__ . '/api/send_messages.php';
        break;

    // ADMIN
    case 'admin/login':
        require __DIR__ . '/admin/login.php';
        break;

    case 'admin/dashboard':
        require __DIR__ . '/admin/dashboard.php';
        break;

    case 'admin/active_users':
        require __DIR__ . '/admin/active_users.php';
        break;

    default:
        http_response_code(404);
        echo json_encode([
            "status" => "error",
            "message" => "Route not found"
        ]);
}