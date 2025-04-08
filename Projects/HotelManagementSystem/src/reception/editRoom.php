<?php
session_start();
include '../../config/db.php';

if (!isset($_SESSION['receptionist_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_id = $_POST['room_id'];
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $id_proof = $_POST['id_proof'];
    $check_in = date('Y-m-d H:i:s');

    // Generate username and password
    $username = strtolower(str_replace(' ', '', $customer_name)) . rand(100, 999);
    $raw_password = 'password123'; // Default password
    $hashed_password = password_hash($raw_password, PASSWORD_BCRYPT);

    // Update room status
    $updateRoom = $conn->prepare("UPDATE rooms SET status = 'occupied' WHERE id = ?");
    $updateRoom->bind_param("i", $room_id);
    $updateRoom->execute();

    // Insert or update customer details
    $stmt = $conn->prepare("INSERT INTO customers (name, phone, id_proof, room_id, username, password, check_in) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)
                            ON DUPLICATE KEY UPDATE name = VALUES(name), phone = VALUES(phone), id_proof = VALUES(id_proof)");
    $stmt->bind_param("sssisss", $customer_name, $phone, $id_proof, $room_id, $username, $hashed_password, $check_in);
    $stmt->execute();

    // Display username and password
    echo "Room assigned successfully.<br>";
    echo "Username: <strong>$username</strong><br>";
    echo "Password: <strong>$raw_password</strong><br>";
    exit();
}

$room_id = $_GET['room_id'];
$stmt = $conn->prepare("SELECT * FROM rooms WHERE id = ?");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();
$room = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Room</title>
    <link rel="stylesheet" href="../../config/styles/style.css">
</head>
<body>
    <h1>Edit Room <?php echo htmlspecialchars($room['room_number']); ?></h1>
    <form action="editRoom.php" method="POST">
        <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">

        <label for="customer_name">Customer Name:</label>
        <input type="text" id="customer_name" name="customer_name" required><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br>

        <label for="id_proof">ID Proof:</label>
        <input type="text" id="id_proof" name="id_proof" required><br>

        <button type="submit">Assign Room</button>
    </form>
</body>
</html>