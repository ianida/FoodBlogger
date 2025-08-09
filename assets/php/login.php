<?php
session_start();
include('../../config.php');
include('../php/connection.php');  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo "Email and password are required.";
        exit;
    }

    // Prepare statement to fetch user by email and password
    $stmt = $conn->prepare("SELECT * FROM signup WHERE email = ? AND password = ? LIMIT 1");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Set session variables
        $_SESSION['fname'] = $user['fname'];
        $_SESSION['lname'] = $user['lname'];
        $_SESSION['emailid'] = $user['email'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['dob'] = $user['dob'];
        $_SESSION['gender'] = $user['gender'];
        $_SESSION['id'] = $user['id'];

        // Store role in session
        $_SESSION['role'] = $user['role'] ?? 'user';  // fallback 'user' if role column missing

        header("Location: " . BASE_URL . "index.php");
        exit;
    } else {
        // Invalid email or password
        header("Location: " . BASE_URL . "modules/login.php?error=Invalid credentials");
        exit;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}
?>
