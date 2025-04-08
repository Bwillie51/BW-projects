<?php
session_start();
include '../../config/db.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

$stmt = $conn->prepare("SELECT name, 'role' FROM users WHERE id = ?"); // Add room_id to Users table
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="../../config/styles/style.css">
</head>
<body>
    

    <ul>
        <li><a href="../reception/viewRoom.php">View Room Details</a></li>
        <li><a href="../storage/requestService.html">Request Room Service</a></li>
        <li><a href="../restaurant/orderFood.html">Order Food</a></li>
        <li><a href="feedback.php">Leave Feedback</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
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