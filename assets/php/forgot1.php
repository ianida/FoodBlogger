<?php
session_start();
include('../../config.php');
include('../../assets/php/connection.php');  

if (!isset($_SESSION['email'])) {
    echo "Session expired. Please start the forgot password process again.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email'];
    $password = trim($_POST['password'] ?? '');

    if (empty($password)) {
        echo "Password is required.";
        exit;
    }

    $hashedPass = $password;

    if (!$conn) {
        echo "Connection error: " . mysqli_connect_error();
        exit;
    }

    $stmt = $conn->prepare("UPDATE signup SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashedPass, $email);

    if ($stmt->execute()) {
        echo "<script>alert('Password successfully changed');</script>";
        // Clear session data related to forgot password
        unset($_SESSION['email'], $_SESSION['random']);
        header("Location: " . BASE_URL . "modules/login.php");
        exit;
    } else {
        echo "Oops, something went wrong: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Show password reset form on GET
    echo '<form method="POST" action="">
            <label>Enter New Password:</label><br>
            <input type="password" name="password" required>
            <input type="submit" value="Reset Password">
          </form>';
}
?>
