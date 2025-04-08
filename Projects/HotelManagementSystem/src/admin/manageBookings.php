<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/db.php';

// Fetch all bookings
$result = $conn->query("SELECT b.id, c.name AS customer_name, r.room_number, b.check_in, b.check_out 
                        FROM bookings b
                        JOIN customers c ON b.customer_id = c.id
                        JOIN rooms r ON b.room_id = r.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="../../config/styles/style.css">
</head>
<body>
    <h1>Manage Bookings</h1>

    <h2>Existing Bookings</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Room Number</th>
                <th>Check-In</th>
                <th>Check-Out</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($booking = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $booking['id']; ?></td>
                    <td><?php echo $booking['customer_name']; ?></td>
                    <td><?php echo $booking['room_number']; ?></td>
                    <td><?php echo $booking['check_in']; ?></td>
                    <td><?php echo $booking['check_out']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>