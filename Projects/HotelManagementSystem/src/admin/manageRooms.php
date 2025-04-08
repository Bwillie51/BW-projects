<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/db.php';

// Handle room creation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_number = $_POST['room_number'];
    $type = $_POST['type'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("INSERT INTO rooms (room_number, type, price, status) VALUES (?, ?, ?, 'available')");
    $stmt->bind_param("ssd", $room_number, $type, $price);
    $stmt->execute();
    echo "Room created successfully.";
}

// Fetch all rooms
$result = $conn->query("SELECT id, room_number, type, price, status FROM rooms");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Rooms</title>
    <link rel="stylesheet" href="../../config/styles/style.css">
</head>
<body>
    <h1>Manage Rooms</h1>

    <h2>Create New Room</h2>
    <form action="manageRooms.php" method="POST">
        <label for="room_number">Room Number:</label>
        <input type="text" id="room_number" name="room_number" required><br>

        <label for="type">Type:</label>
        <input type="text" id="type" name="type" required><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required><br>

        <button type="submit">Create Room</button>
    </form>

    <h2>Existing Rooms</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Room Number</th>
                <th>Type</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($room = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $room['id']; ?></td>
                    <td><?php echo $room['room_number']; ?></td>
                    <td><?php echo $room['type']; ?></td>
                    <td><?php echo $room['price']; ?></td>
                    <td><?php echo $room['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>