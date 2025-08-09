<?php
session_start();
include('../../config.php');
include('../../assets/php/connection.php'); 

if (!$conn) {
    echo "Connection Error";
    exit;
}

$comment = base64_encode($_POST['addcomment']);
$author = $_SESSION['fname'] . " " . $_SESSION['lname'];
$p_id = $_SESSION['pid'];

$commentadd = "INSERT INTO comments(comment, author, p_id) VALUES ('$comment', '$author', '$p_id')";

if (!mysqli_query($conn, $commentadd)) {
    echo "<script>alert('Not inserted');</script>";
} else {
    header("Location: " . BASE_URL . "modules/video.php?p_id=" . $p_id);
    exit;
}
?>
