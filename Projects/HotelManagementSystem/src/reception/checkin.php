<?php
include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $id_proof = $_POST['id_proof'];
    $room_id = $_POST['room_id'];
    $check_in = date('Y-m-d H:i:s');

    // Generate username and password
    $username = strtolower(str_replace(' ', '', $name)) . rand(100, 999);
    $raw_password = 'password123'; // Default password
    $hashed_password = password_hash($raw_password, PASSWORD_BCRYPT);

    // Update room status
    $updateRoom = $conn->prepare("UPDATE rooms SET status = 'occupied' WHERE id = ?");
    $updateRoom->bind_param("i", $room_id);
    $updateRoom->execute();

    // Insert customer details
    $stmt = $conn->prepare("INSERT INTO customers (name, phone, id_proof, room_id, username, password, check_in) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisss", $name, $phone, $id_proof, $room_id, $username, $hashed_password, $check_in);
    $stmt->execute();

    // Display username and password
    echo "Customer checked in successfully.<br>";
    echo "Username: <strong>$username</strong><br>";
    echo "Password: <strong>$raw_password</strong><br>";
}
?>