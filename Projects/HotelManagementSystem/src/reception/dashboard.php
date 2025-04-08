<?php
session_start();
include '../../config/db.php';

if (!isset($_SESSION['receptionist_id'])) {
    header("Location: login.php");
    exit();
}

$receptionist_id = $_SESSION['receptionist_id'];

$stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
$stmt->bind_param("i", $receptionist_id);
$stmt->execute();
$result = $stmt->get_result();
$receptionist = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reception Dashboard</title>
    <link rel="stylesheet" href="../../config/styles/style.css">
    <style>
        .assigned { background-color: #d4edda; } /* Green for assigned rooms */
        .not-assigned { background-color: #ffffff; } /* White for unassigned rooms */
        .not-ready { background-color: #ffeeba; } /* Orange for not-ready rooms */
    </style>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($receptionist['name']); ?>!</h1>

    <h2>Reception Dashboard</h2>
    <ul>
        <li><a href="viewRoom.php?room_id=<?php echo $room['id']; ?>">View Room Details</a></li>
        <li><a href="../storage/requestService.html">Request Room Service</a></li>
        <li><a href="../restaurant/orderFood.html">Order Food</a></li>
        
        <li><a href="feedback.php">Leave Feedback</a></li>
        <li><a href="editRoom.php?room_id=1">Edit</a>
        <li><a href="logout.php">Logout</a></li>
    </ul>

    <h2>All Rooms</h2>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Room Number</th>
                <th>Type</th>
                <th>Status</th>
                <th>Price</th>
                <th>Customer Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rooms = $conn->query("SELECT r.id, r.room_number, r.type, r.status, r.price, c.name AS customer_name 
                                   FROM rooms r 
                                   LEFT JOIN customers c ON r.id = c.room_id");

            while ($room = $rooms->fetch_assoc()) {
                $row_class = '';
                if ($room['status'] === 'occupied') {
                    $row_class = 'assigned';
                } elseif ($room['status'] === 'not-ready') {
                    $row_class = 'not-ready';
                } else {
                    $row_class = 'not-assigned';
                }
            ?>
                <tr class="<?php echo $row_class; ?>">
                    <td><?php echo htmlspecialchars($room['room_number']); ?></td>
                    <td><?php echo htmlspecialchars($room['type']); ?></td>
                    <td><?php echo htmlspecialchars($room['status']); ?></td>
                    <td><?php echo htmlspecialchars($room['price']); ?></td>
                    <td><?php echo htmlspecialchars($room['customer_name'] ?? 'N/A'); ?></td>
                    <td>
                        <a href="editRoom.php?room_id=<?php echo $room['id']; ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <h2>Notifications</h2>
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Message</th>
            <th>Status</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $notifications = $conn->query("SELECT message, status, updated_at FROM notifications WHERE user_type = 'admin'");
        while ($notification = $notifications->fetch_assoc()):
        ?>
            <tr style="background-color: <?php echo $notification['status'] === 'completed' ? '#d4edda' : ($notification['status'] === 'in-progress' ? '#ffeeba' : '#f8d7da'); ?>">
                <td><?php echo htmlspecialchars($notification['message']); ?></td>
                <td><?php echo htmlspecialchars($notification['status']); ?></td>
                <td><?php echo htmlspecialchars($notification['updated_at']); ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>