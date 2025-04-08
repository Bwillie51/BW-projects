<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Analytics Dashboard</title>
    <link rel="stylesheet" href="../../config/styles/style.css">
</head>
<body>
    <h1>Analytics Dashboard</h1>
    <p>Feature coming soon...</p>
</body>
</html>