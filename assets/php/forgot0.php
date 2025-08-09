<?php
session_start();
include('../../config.php');
include('../../assets/php/connection.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $random = $_SESSION['random'] ?? null;
    $otp = trim($_POST['otp'] ?? '');

    if (!$random) {
        echo "Session expired. Please start the process again.";
        exit;
    }

    if ($random !== $otp) {
        echo "<h3>Wrong OTP. Please try again.</h3>";
        echo '<form method="POST" action="">
                <label>Enter OTP sent to your email:</label><br>
                <input type="text" name="otp" required>
                <input type="submit" value="Verify OTP">
              </form>';
        exit;
    } else {
        header("Location: " . BASE_URL . "modules/forgot1.php");
        exit;
    }
} else {
    // If accessed via GET, show OTP input form
    echo '<form method="POST" action="">
            <label>Enter OTP sent to your email:</label><br>
            <input type="text" name="otp" required>
            <input type="submit" value="Verify OTP">
          </form>';
}
