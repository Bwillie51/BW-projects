<?php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Explicitly pass the role from the login form

    // Debugging: Check input values
    echo "Username: $username<br>";
    echo "Role: $role<br>";

    // Determine the table and redirect path based on the role
    if ($role === 'customer') {
        $table = 'users';
        $redirect = 'customer/dashboard.php';
    } elseif ($role === 'receptionist') {
        $table = 'users';
        $redirect = 'reception/dashboard.php';
    } elseif ($role === 'admin') {
        $table = 'users';
        $redirect = 'admin/dashboard.php';
    } elseif ($role === 'housekeeping') {
        $table = 'users'; // Assuming housekeeping staff are stored in the 'users' table
        $redirect = 'storage/dashboard.php';
    } elseif ($role === 'restaurant') {
        $table = 'users'; // Assuming restaurant staff are stored in the 'users' table
        $redirect = 'restaurant/dashboard.php';
    } else {
        echo "Invalid role.";
        exit();
    }

    // Debugging: Check table and redirect path
    echo "Table: $table<br>";
    echo "Redirect: $redirect<br>";

    // Validate credentials


$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ? AND role = ?");
$stmt->bind_param("ss", $username, $role);
$stmt->execute();
$result = $stmt->get_result();

    /*
    $stmt = $conn->prepare("SELECT id, password FROM $table WHERE username = ? AND role = ?");
    $stmt->bind_param("ss", $username, $role);
    $stmt->execute();
    $result = $stmt->get_result();
*/
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Debugging: Check fetched data
        echo "Fetched User ID: " . $user['id'] . "<br>";
        echo "Fetched Password Hash: " . $user['password'] . "<br>";

        if (password_verify($password, $user['password'])) {
            $_SESSION[$role . '_id'] = $user['id'];
            header("Location: $redirect");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid username.";
    }
}
?>