<?php
session_start();
include '../../config/db.php';

// Fetch all pending food orders
$orders = $conn->query("SELECT fo.id, c.name AS customer_name, fo.food_item, fo.quantity, fo.status, fo.created_at 
                        FROM food_orders fo
                        JOIN customers c ON fo.customer_id = c.id
                        WHERE fo.status = 'pending'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Restaurant Dashboard</title>
    <link rel="stylesheet" href="../../config/styles/style.css">
</head>
<body>
<h1>Restaurant Dashboard</h1>
<h2>Pending Food Orders <span id="new-orders-badge" style="background-color: red; color: white; padding: 5px; border-radius: 5px; display: none;">New</span></h2>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Food Item</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($order = $orders->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                    <td><?php echo htmlspecialchars($order['food_item']); ?></td>
                    <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($order['status']); ?></td>
                    <td>
                        <form action="updateOrder.php" method="POST" style="display:inline;">
                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                            <button type="submit" name="action" value="in-progress">Mark as In-Progress</button>
                            <button type="submit" name="action" value="completed">Mark as Completed</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <!--<script src="script.js"></script>-->
    <script>
    function checkNewOrders() {
        fetch('getNewOrders.php')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('new-orders-badge');
                if (data.new_orders > 0) {
                    badge.style.display = 'inline';
                    badge.textContent = `New (${data.new_orders})`;
                } else {
                    badge.style.display = 'none';
                }
            })
            .catch(error => console.error('Error fetching new orders:', error));
    }

    // Check for new orders every 5 seconds
    setInterval(checkNewOrders, 5000);
    checkNewOrders(); // Initial check
</script>
</body>
</html>