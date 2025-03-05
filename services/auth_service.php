<?php
require 'config.php'; // Verbindung zur Datenbank
header('Content-Type: application/json');
session_start();

$input = json_decode(file_get_contents("php://input"), true);
$email = trim($input['email'] ?? '');
$password = trim($input['password'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($email) && !empty($password)) {
    $stmt = $pdo->prepare("SELECT id, password_hash, role FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        echo json_encode(['success' => true, 'role' => $user['role'], 'token' => session_id()]);
    } else {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Ungültige Anmeldedaten']);
    }
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Fehlende Eingaben']);
}
?>
