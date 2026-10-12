<?php
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'GET') {
    http_response_code(200);
    echo json_encode([
        'ok' => true,
        'service' => 'MoonAntiCheat API Test',
        'message' => 'PHP API çalışıyor'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($method === 'POST') {
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

    if (stripos($contentType, 'application/json') === false) {
        http_response_code(415);
        echo json_encode([
            'ok' => false,
            'error' => 'Content-Type application/json olmalı'
        ]);
        exit;
    }

    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true);

    if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
        http_response_code(400);
        echo json_encode([
            'ok' => false,
            'error' => 'Geçersiz JSON'
        ]);
        exit;
    }

    http_response_code(200);
    echo json_encode([
        'ok' => true,
        'service' => 'MoonAntiCheat API Test',
        'received' => $data
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

header('Allow: GET, POST');
http_response_code(405);
echo json_encode([
    'ok' => false,
    'error' => 'Method not allowed'
]);
