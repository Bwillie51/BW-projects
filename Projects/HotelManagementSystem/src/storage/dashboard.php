<?php
session_start();
include '../../config/db.php';

// Fetch all pending room service requests
$requests = $conn->query("SELECT rs.id, r.room_number, rs.request_details, rs.status, rs.created_at 
                          FROM room_service_requests rs
                          JOIN rooms r ON rs.room_id = r.id
                          WHERE rs.status = 'pending'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Housekeeping Dashboard</title>
    <link rel="stylesheet" href="../../config/styles/style.css">
</head>
<body>
<h1>Housekeeping Dashboard</h1>
<h2>Pending Room Service Requests <span id="new-requests-badge" style="background-color: red; color: white; padding: 5px; border-radius: 5px; display: none;">New</span></h2>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Room Number</th>
                <th>Request Details</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($request = $requests->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $request['id']; ?></td>
                    <td><?php echo htmlspecialchars($request['room_number']); ?></td>
                    <td><?php echo htmlspecialchars($request['request_details']); ?></td>
                    <td><?php echo htmlspecialchars($request['status']); ?></td>
                    <td>
                        <form action="updateRequest.php" method="POST" style="display:inline;">
                            <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
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
    function checkNewRequests() {
        fetch('getNewRequests.php')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('new-requests-badge');
                if (data.new_requests > 0) {
                    badge.style.display = 'inline';
                    badge.textContent = `New (${data.new_requests})`;
                } else {
                    badge.style.display = 'none';
                }
            })
            .catch(error => console.error('Error fetching new requests:', error));
    }

    // Check for new requests every 5 seconds
    setInterval(checkNewRequests, 5000);
    checkNewRequests(); // Initial check
</script>
</body>
</html>