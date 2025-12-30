<?php
$conn = new mysqli('localhost', 'root', '', 'test');
if ($conn->connect_error) die('Connection failed');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = $conn->query('SELECT * FROM users');
    $users = [];
    while ($row = $result->fetch_assoc()) $users[] = $row;
    echo json_encode($users);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action == 'create') {
        $stmt = $conn->prepare('INSERT INTO users (name, email) VALUES (?, ?)');
        $stmt->bind_param('ss', $_POST['name'], $_POST['email']);
        $stmt->execute();
    } elseif ($action == 'update') {
        $stmt = $conn->prepare('UPDATE users SET name=?, email=? WHERE id=?');
        $stmt->bind_param('ssi', $_POST['name'], $_POST['email'], $_POST['id']);
        $stmt->execute();
    } elseif ($action == 'delete') {
        $stmt = $conn->prepare('DELETE FROM users WHERE id=?');
        $stmt->bind_param('i', $_POST['id']);
        $stmt->execute();
    }
}
$conn->close();
?>