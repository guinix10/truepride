<?php
session_start();

header('Content-Type: application/json');

if (isset($_SESSION['user_id'])) {
    echo json_encode(['success' => true, 'user' => $_SESSION['user_name'], 'type' => $_SESSION['user_type']]);
} else {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Não autorizado']);
}
