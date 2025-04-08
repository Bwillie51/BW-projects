<?php
include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $action = $_POST['action'];

    // Update the food order status
    $stmt = $conn->prepare("UPDATE food_orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $action, $order_id);
    $stmt->execute();

    // Fetch the customer ID for the order
    $stmt = $conn->prepare("SELECT customer_id FROM food_orders WHERE id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();
    $customer_id = $order['customer_id'];

    // Insert or update the notification for the customer
    $message = "Your food order is now $action.";
    $stmt = $conn->prepare("INSERT INTO notifications (user_type, user_id, message, status) 
                            VALUES ('customer', ?, ?, ?)
                            ON DUPLICATE KEY UPDATE message = VALUES(message), status = VALUES(status)");
    $stmt->bind_param("iss", $customer_id, $message, $action);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>