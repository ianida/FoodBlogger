<?php
session_start();
include('../../config.php');
include('../../assets/php/connection.php');

if (!isset($_SESSION['id'])) {
    header("Location: " . BASE_URL . "modules/login.php");
    exit();
}

$userId = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request method.");
}

$recipeId = intval($_POST['id']);
$dname = $_POST['dname'];
$cusine = $_POST['cusine'];
$course = $_POST['course'];
$recepie = base64_encode($_POST['recepie']);
$description = base64_encode($_POST['description'] ?? '');

$oldVideo = $_POST['old_videol'] ?? '';
$oldImage = $_POST['old_image'] ?? '';

// Handle video upload
if (isset($_FILES['video']) && $_FILES['video']['error'] === 0) {
    $videoTmp = $_FILES['video']['tmp_name'];
    $videoName = preg_replace('/\s+/', '', $_FILES['video']['name']);
    $videoPath = __DIR__ . '/../video/' . $videoName;
    if (move_uploaded_file($videoTmp, $videoPath)) {
        $videol = BASE_URL . 'assets/video/' . $videoName;
    } else {
        $videol = $oldVideo;
    }
} else {
    $videol = $oldVideo;
}

// Handle image upload
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $imageTmp = $_FILES['image']['tmp_name'];
    $imageName = preg_replace('/\s+/', '', $_FILES['image']['name']);
    $imagePath = __DIR__ . '/../img/' . $imageName;
    if (move_uploaded_file($imageTmp, $imagePath)) {
        $imagel = BASE_URL . 'assets/img/' . $imageName;
    } else {
        $imagel = $oldImage;
    }
} else {
    $imagel = $oldImage;
}

$stmt = $conn->prepare("UPDATE videos SET dname=?, cusine=?, course=?, recepie=?, description=?, videol=?, image=? WHERE id=? AND user_id=?");
$stmt->bind_param("sssssssii", $dname, $cusine, $course, $recepie, $description, $videol, $imagel, $recipeId, $userId);

if ($stmt->execute()) {
    header("Location: " . BASE_URL . "modules/manage_recipes.php?msg=updated");
    exit();
} else {
    die("Update failed: " . $stmt->error);
}
?>
