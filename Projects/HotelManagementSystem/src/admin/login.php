<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../../config/styles/style.css">
</head>
<body>
    <div class="nav-container">
        <div class="nav-bar">
        <ul>
            <li><a href="../../index.php">Home</a></li>
        </ul>
        </div>
    </div>
    <div class="header-container">
    <div class="header">
        <h1>Welcome to Our Hotel Management System</h1>
        <p>Your one-stop solution for managing hotel operations efficiently.</p>
    </div>
    </div>
    </div>
    <div class="content">
    <div class="content-container">
    <div class="content-item">
        <h2>Admin Login</h2>
    </div>
    </div>
    </div> 
    <div class="login-container">
    <div class="login-image">
        <img src="../../config/images/admin.png" alt="Admin Image">
    </div>
    <div class="login-form">
    <form action="../loginlogic.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <!-- Hidden field to specify the role -->
        <input type="hidden" name="role" value="admin">

        <button type="submit">Login</button>
    </form>
</body>
</html>
