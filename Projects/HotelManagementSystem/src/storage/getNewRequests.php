<?php
include '../../config/db.php';

// Fetch the count of pending room service requests
$result = $conn->query("SELECT COUNT(*) AS new_requests FROM room_service_requests WHERE status = 'pending'");
$data = $result->fetch_assoc();

echo json_encode($data);
?>