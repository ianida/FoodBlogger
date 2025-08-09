<?php
session_start();

include('../../config.php');   // BASE_URL and config
include('../../assets/php/connection.php');  // $conn database connection

// PHPMailer required files and namespace
require '../../assets/phpmailer/Exception.php';
require '../../assets/phpmailer/PHPMailer.php';
require '../../assets/phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {

    // CAPTCHA verification function
    function CheckCaptcha($userResponse)
    {
        $fields = [
            'secret' => '6Ld7mXQUAAAAAFZhouVhfgZ8vpeSDctqIp0UgnVF',
            'response' => $userResponse
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($ch);
        curl_close($ch);

        return json_decode($res, true);
    }

    $result = CheckCaptcha($_POST['g-recaptcha-response']);

    if ($result['success']) {
        // Sanitize inputs
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $email = trim($_POST['emailid']);
        $contact = trim($_POST['phone']);
        $dob = trim($_POST['dob']);
        $gender = trim($_POST['gender']);
        $role = trim($_POST['role'] ?? 'user');  // default to user if not set
        

        // Save inputs in session for reuse if needed
        $_SESSION['tfname'] = $fname;
        $_SESSION['tlname'] = $lname;
        $_SESSION['temailid'] = $email;
        $_SESSION['tphone'] = $contact;
        $_SESSION['tdob'] = $dob;
        $_SESSION['tgender'] = $gender;
        $_SESSION['trole'] = $role;

        // Generate a random verification code
        $verification_code = rand(1000, 1000000);
        $_SESSION['random'] = $verification_code;

        // Check if email already exists
        $stmt = $conn->prepare("SELECT email FROM signup WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            echo "<script>alert('Email ID is already taken. Please try another email.'); window.location.href = '" . BASE_URL . "modules/signup.php';</script>";
            exit();
        }
        $stmt->close();

        // Prepare PHPMailer to send verification email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';

            $mail->Username = 'middlebreakfast03@gmail.com';
            $mail->Password = 'vgfwwbiycsjhdoyw';

            $mail->setFrom('middlebreakfast03@gmail.com', 'Recipe Hub');
            $mail->addAddress($email);
            $mail->addReplyTo('middlebreakfast03@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = 'Email verification';
            $mail->Body = '<h1>Hello ' . htmlspecialchars($fname) . ',</h1><p>Your verification code is <strong>' . $verification_code . '</strong></p>';

            if ($mail->send()) {
                header("Location: " . BASE_URL . "modules/signup1.php");
                exit();
            } else {
                echo "<script>alert('Failed to send verification email. Please try again.'); window.location.href = '" . BASE_URL . "modules/signup.php';</script>";
                exit();
            }
        } catch (Exception $e) {
            echo "<script>alert('Mailer Error: " . $mail->ErrorInfo . "'); window.location.href = '" . BASE_URL . "modules/signup.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Please verify you are not a robot!'); window.location.href = '" . BASE_URL . "modules/signup.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href = '" . BASE_URL . "modules/signup.php';</script>";
    exit();
}
