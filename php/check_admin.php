<?php
session_start();

header('Content-Type: application/json');

if (isset($_SESSION['user_id']) && $_SESSION['user_type'] === 'admin') {
    echo json_encode(['success' => true, 'user' => $_SESSION['user_name']]);
} else {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Não autorizado']);
}
