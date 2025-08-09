<?php
session_start();
include('../../config.php');   
include('../../assets/php/connection.php');  

// Check required session data from signup steps
if (!isset($_SESSION['tfname'], $_SESSION['tlname'], $_SESSION['temailid'], $_SESSION['tphone'], $_SESSION['tdob'], $_SESSION['tgender'])) {
    echo "Session expired. Please <a href='" . BASE_URL . "modules/signup.php'>start signup again</a>.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_SESSION['tfname'];
    $lname = $_SESSION['tlname'];
    $email = $_SESSION['temailid'];
    $phone = $_SESSION['tphone'];
    $dob = $_SESSION['tdob'];
    $gender = $_SESSION['tgender'];
    $pass = trim($_POST['pass'] ?? '');

    if (empty($pass)) {
        echo "Password is required.";
        exit;
    }

    // Hash password securely
    //$hashedPass = password_hash($pass, PASSWORD_DEFAULT);
    $hashedPass = $pass; // Save password as plain text


    // Check if email already exists - redundant if already checked earlier, but safe
    $stmt = $conn->prepare("SELECT email FROM signup WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "Email is already taken.";
        $stmt->close();
        exit;
    }
    $stmt->close();

    // Insert new user into signup table
    $stmt = $conn->prepare("INSERT INTO signup (fname, lname, email, phone, dob, gender, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $fname, $lname, $email, $phone, $dob, $gender, $hashedPass);

    if ($stmt->execute()) {
        // Set logged-in session variables (optional)
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['emailid'] = $email;  // use emailid for consistency
        $_SESSION['phone'] = $phone;
        $_SESSION['dob'] = $dob;
        $_SESSION['gender'] = $gender;

        // Clear temporary signup session data
        unset($_SESSION['tfname'], $_SESSION['tlname'], $_SESSION['temailid'], $_SESSION['tphone'], $_SESSION['tdob'], $_SESSION['tgender'], $_SESSION['random']);

        // Redirect to home or login page
        header("Location: " . BASE_URL . "index.php");
        exit;
    } else {
        echo "Error inserting data: " . $stmt->error;
    }
    $stmt->close();
} else {
    // Show password creation form on GET request
    echo '<form method="POST" action="">
            <label>Create Password:</label><br>
            <input type="password" name="pass" required autofocus>
            <input type="submit" value="Complete Signup">
          </form>';
}
