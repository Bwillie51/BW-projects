<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/db.php';

// Handle user creation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (name, username, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $username, $password, $role);
    $stmt->execute();
    echo "User created successfully.";
}

// Fetch all users
$result = $conn->query("SELECT id, name, username, role FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="../../config/styles/style.css">
</head>
<body>
    <div class = "header">
        <h1>Manage Users</h1>  
    </div>
    <div class = "topnav">
        <a href="manageUsers.php">Manage Users</a>
        <a href="manageRooms.php">Manage Rooms</a>
        <a href="manageBookings.php">Manage Bookings</a>
        <a href="systemSettings.php">System Settings</a>
        <a href="analytics.php">Analytics Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class = "row">
        <div class = "column side">
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
                    <option value="customer">Customer</option>
                    <option value="housekeeping">House Keeping</option>
                    <option value="restaurant">Restaurant</option>
                </select><br>

                <button type="submit">Create User</button>
            </form>
        </div>
        <div class = "column middle">
            <h2>Existing Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['role']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

************************************************************************************************************************************************************************************
    <!--<h1>Manage Users</h1>

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
            <option value="customer">Customer</option>
            <option value="housekeeping">House Keeping</option>
            <option value="restaurant">Restaurant</option>
        </select><br>

        <button type="submit">Create User</button>
    </form>

    <h2>Existing Users</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</body>
</html>
            -->