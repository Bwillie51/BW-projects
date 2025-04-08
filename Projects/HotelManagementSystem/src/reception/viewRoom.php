<?php
if (!isset($_GET['room_id']) || empty($_GET['room_id'])) {
    echo "Debug: room_id is missing in the GET request.<br>";
    echo json_encode(["error" => "Room ID is required."]);
    exit();
}


include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['room_id']) || empty($_GET['room_id'])) {
        echo json_encode(["error" => "Room ID is required."]);
        exit();
    }

    $room_id = $_GET['room_id'];

    $stmt = $conn->prepare("SELECT r.room_number, r.type, r.status, r.price, c.name AS customer_name 
                            FROM rooms r 
                            LEFT JOIN customers c ON r.id = c.room_id 
                            WHERE r.id = ?");
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();
        echo json_encode($room);
    } else {
        echo json_encode(["error" => "Room not found."]);
    }
}
?>