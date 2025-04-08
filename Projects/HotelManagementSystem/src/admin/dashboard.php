<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/db.php'; // Include the database connection
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../config/styles/dashboard.styles.css">
</head>
<body>
    <div class="admin-header">
        <h1>Admin Dashboard</h1>
    </div>
    <div class="topnav">
        <select id="drop-down" name="drop-down" onchange="location = this.value;">
        <option value=""><a href="../config/images/Dropdown.webp"></a>Select an option</option>
        <option value="manageUsers.php">Manage Users</option>
        <option value="manageRooms.php">Manage Rooms</option>
        <option value="manageBookings.php">Manage Bookings</option>
        <option value="systemSettings.php">System Settings</option>
        <option value="analytics.php">Analytics Dashboard</option>
        <option value="logout.php">Logout</option>
    </div>

    <div classs="row">
        <div class="column-side1">
            <h2>Create New User</h2>
            <form action="manageUsers.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>

                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="receptionist">Receptionist</option>
                    <option value="admin">Admin</option>
                </select><br>

                <input type="submit" value="Create User">
            </form>
        </div>
        
        <div class="column-side2">
            <div class ="column-side">
            <h2>All Users</h2>
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch all users
                    $result = $conn->query("SELECT id, name, username, role FROM users");
                    while ($user = $result->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['role']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            </div>
            <div class="column-side">
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
                    // Fetch notifications for admin
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
        </div>
        </div>

    </div>
    <div class="footer">
        <p>&copy; 2023 Hotel Management System</p>
    </div>
</body>
</html>
<!--
    <h1>Welcome, Admin!</h1>
    <p>This is your dashboard.</p>
    <ul>
        <li><a href="manageUsers.php">Manage Users</a></li>
        <li><a href="manageRooms.php">Manage Rooms</a></li>
        <li><a href="manageBookings.php">Manage Bookings</a></li>
        <li><a href="systemSettings.php">System Settings</a></li>
        <li><a href="analytics.php">Analytics Dashboard</a></li>
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
        Put the PHP code above in here.
    </tbody>
</table>
</body>
</html>
// -->