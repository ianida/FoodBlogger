<?php
session_start();
include('../../config.php');
include('../../assets/php/connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $em = trim($_POST['email']);
    $_SESSION['email'] = $em;

    if (!$conn) {
        echo "Connection error: " . mysqli_connect_error();
        exit;
    }

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM signup WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $em);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $a = rand(1000, 1000000);
        $_SESSION['random'] = $a;

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'middlebreakfast03@gmail.com';  // SMTP email
            $mail->Password = 'vgfwwbiycsjhdoyw';  // SMTP password or app password here (tyo google account ko)

            $mail->setFrom('middlebreakfast03@gmail.com', 'Recipe Hub');
            $mail->addAddress($em);
            $mail->addReplyTo('middlebreakfast03@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Verification Code';
            $mail->Body = '<h1 align="center">Your one-time password is <strong>' . $a . '</strong></h1>';

            $mail->send();

            header("Location: " . BASE_URL . "modules/forgot0.php");
            exit;
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            exit;
        }
    } else {
        echo "Email not found.";
        exit;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
    exit;
}
