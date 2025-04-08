<!DOCTYPE html>
<html lang="en">
<head>
    <title>Restaurant Login</title>
    <link rel="stylesheet" href="../../config/styles/style.css">
</head>
<body>
    <h1>Restaurant Login</h1>
    <form action="../loginlogic.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <!-- Hidden field to specify the role -->
        <input type="hidden" name="role" value="restaurant">

        <button type="submit">Login</button>
    </form>
</body>
</html>