<?php
session_start();
include('../../config.php'); // For BASE_URL
include('../../assets/php/connection.php'); // includes $conn (mysqli connection)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    
    // Email is readonly, get from session or hidden input (better from session)
    $email = $_SESSION['emailid'] ?? '';

    if (!$email) {
        // Email not found, redirect to profile page or login
        header("Location: " . BASE_URL . "modules/manage_profile.php");
        exit;
    }

    // Prepare update query
    $sql = "UPDATE signup SET fname=?, lname=?, phone=?, dob=?, gender=? WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $fname, $lname, $phone, $dob, $gender, $email);
        if (mysqli_stmt_execute($stmt)) {
            // Success: optionally update session variables
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['phone'] = $phone;
            $_SESSION['dob'] = $dob;
            $_SESSION['gender'] = $gender;

            header("Location: " . BASE_URL . "modules/manage_profile.php?update=success");
            exit;
        } else {
            // SQL error
            die("Error updating profile: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt);
    } else {
        die("Failed to prepare statement: " . mysqli_error($conn));
    }

    mysqli_close($conn);
} else {
    // If not POST request, redirect or show error
    header("Location: " . BASE_URL . "modules/manage_profile.php");
    exit;
}
?>
