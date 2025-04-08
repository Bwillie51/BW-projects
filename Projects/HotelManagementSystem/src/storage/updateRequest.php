<?php
include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    // Update the room service request status
    $stmt = $conn->prepare("UPDATE room_service_requests SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $action, $request_id);
    $stmt->execute();

    // Fetch the room ID for the request
    $stmt = $conn->prepare("SELECT room_id FROM room_service_requests WHERE id = ?");
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $request = $result->fetch_assoc();
    $room_id = $request['room_id'];

    // Insert or update the notification for the receptionist
    $message = "Room service request for room $room_id is now $action.";
    $stmt = $conn->prepare("INSERT INTO notifications (user_type, user_id, message, status) 
                            VALUES ('reception', ?, ?, ?)
                            ON DUPLICATE KEY UPDATE message = VALUES(message), status = VALUES(status)");
    $stmt->bind_param("iss", $room_id, $message, $action);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>