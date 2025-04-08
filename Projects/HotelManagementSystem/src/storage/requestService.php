<?php
include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $service = $_POST['service'];

    $stmt = $conn->prepare("INSERT INTO service_requests (customer_id, service, status) VALUES (?, ?, 'pending')");
    $stmt->bind_param("is", $customer_id, $service);
    $stmt->execute();

    echo "Service request submitted successfully.";
}
?>