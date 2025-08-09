<?php
session_start();

header('Content-Type: text/html; charset=utf-8');

include('../../config.php');
include('../../assets/php/connection.php');  

// Sanitize inputs
$commentnewCount = isset($_POST['commentnewCount']) ? intval($_POST['commentnewCount']) : 5;
$commentCurrentCount = isset($_POST['commentCurrentCount']) ? intval($_POST['commentCurrentCount']) : 0;
$commentid = isset($_POST['commentid']) ? intval($_POST['commentid']) : 0;

if ($commentid <= 0) {
    echo "Invalid comment ID.";
    exit;
}

$sql = "SELECT * FROM comments WHERE p_id = ? LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $commentid, $commentCurrentCount, $commentnewCount);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>" . htmlspecialchars(base64_decode($row['comment'])) . "</p>";
        echo "<br>";
        echo "<h3>- " . htmlspecialchars($row['author']) . "</h3>";
        echo "<hr style='width:100%'>";
    }
} else {
    echo "There are no comments";
}

$stmt->close();
$conn->close();
