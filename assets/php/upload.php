<?php
session_start();
include('../../config.php');  
include('../../assets/php/connection.php'); 

if (!isset($_SESSION['fname'])) {
    header('Location: ' . BASE_URL . 'modules/login.php');
    exit;
}

// Validate connection
if (!$conn) {
    die('Connection Error: ' . mysqli_connect_error());
}

// Sanitize and assign POST values
$dname = mysqli_real_escape_string($conn, $_POST['dname']);
$cusine = mysqli_real_escape_string($conn, $_POST['cusine']);
$course = mysqli_real_escape_string($conn, $_POST['course']);

// Sanitize files and remove spaces from names
$video_name = preg_replace('/\s+/', '', $_FILES['video']['name']);
$video_temp = $_FILES['video']['tmp_name'];

$image_name = isset($_FILES['image']['name']) ? preg_replace('/\s+/', '', $_FILES['image']['name']) : '';
$image_temp = $_FILES['image']['tmp_name'] ?? null;

// Process recipe and description
$rawrecipe = $_POST['recepie'];
$rmvspace = str_replace(' ', '&nbsp;', $rawrecipe);
$nxtline = nl2br($rmvspace);
$recepie = base64_encode($nxtline);

$description = base64_encode($_POST['description'] ?? '');

// Move uploaded video
$video_upload_path = __DIR__ . "/../video/" . $video_name;
if (!move_uploaded_file($video_temp, $video_upload_path)) {
    die("Failed to upload video.");
}
$videol = BASE_URL . "assets/video/$video_name";

// Move uploaded image if provided
if ($image_name && $image_temp) {
    $image_upload_path = __DIR__ . "/../img/" . $image_name;
    if (!move_uploaded_file($image_temp, $image_upload_path)) {
        die("Failed to upload image.");
    }
    $imagel = BASE_URL . "assets/img/$image_name";
} else {
    $imagel = ""; // or default image URL if you want
}

$name = $_SESSION['fname'] . " " . $_SESSION['lname'];

// Insert into DB - Use prepared statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO videos (dname, cusine, course, videol, recepie, description, image, name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $dname, $cusine, $course, $videol, $recepie, $description, $imagel, $name);

if ($stmt->execute()) {
    header("Location: " . BASE_URL . "index.php");
    exit;
} else {
    echo "Couldn't upload: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
