<?php
include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $food_item = $_POST['food_item'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("INSERT INTO food_orders (customer_id, food_item, quantity, status) VALUES (?, ?, ?, 'pending')");
    $stmt->bind_param("isi", $customer_id, $food_item, $quantity);
    $stmt->execute();

    echo "Food order placed successfully.";
}
?>