<?php
session_start();
include('../../config.php');  

// Show the OTP form
function showForm($error = '') {
    if ($error) {
        echo "<p style='color:red;'>$error</p>";
    }
    echo '<form method="POST" action="">
            <label>Enter OTP sent to your email:</label><br>
            <input type="text" name="otp" required autofocus>
            <input type="submit" value="Verify OTP">
          </form>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $random = $_SESSION['random'] ?? null;
    $otp = trim($_POST['otp'] ?? '');

    if (!$random) {
        echo "<p>Session expired. Please <a href='" . BASE_URL . "modules/signup.php'>start signup again</a>.</p>";
        exit;
    }

    if ($random !== $otp) {
        // OTP wrong: show form again with error
        showForm('Wrong OTP. Please try again.');
        exit;
    } else {
        // OTP correct: Insert user data into database here

        // Make sure user data exists in session from signup.php
        if (!isset($_SESSION['temailid'], $_SESSION['tfname'], $_SESSION['tlname'], $_SESSION['tphone'], $_SESSION['tdob'], $_SESSION['tgender'])) {
            echo "<p>Session data missing. Please <a href='" . BASE_URL . "modules/signup.php'>start signup again</a>.</p>";
            exit;
        }

        include('../../assets/php/connection.php'); // Get $conn

        $fname = $_SESSION['tfname'];
        $lname = $_SESSION['tlname'];
        $email = $_SESSION['temailid'];
        $phone = $_SESSION['tphone'];
        $dob = $_SESSION['tdob'];
        $gender = $_SESSION['tgender'];

        // Prepare and insert user data
        $stmt = $conn->prepare("INSERT INTO signup (fname, lname, email, phone, dob, gender) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $fname, $lname, $email, $phone, $dob, $gender);

        if ($stmt->execute()) {
            // Clear session signup data
            unset($_SESSION['tfname'], $_SESSION['tlname'], $_SESSION['temailid'], $_SESSION['tphone'], $_SESSION['tdob'], $_SESSION['tgender'], $_SESSION['random']);

            // Redirect to success or login page
            header("Location: " . BASE_URL . "modules/login.php");
            exit;
        } else {
            echo "<p>Database error: Could not complete signup. Please try again.</p>";
            showForm();
            exit;
        }
    }
} else {
    // GET request: show OTP input form
    showForm();
}
?>
