<?php 
session_start();
include_once('../config.php');  

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$error = ''; // To store error message if OTP wrong

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $random = $_SESSION['random'] ?? null;
    $otp = trim($_POST['otp'] ?? '');

    if (!$random) {
        $error = "Session expired. Please start the process again.";
    } else {
        if (trim((string)$random) !== trim((string)$otp)) {
            $error = "Wrong OTP. Please try again.";
        } else {
            header("Location: " . BASE_URL . "modules/forgot1.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot OTP</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <style>
        /* Full background setup */
        .fullBackground {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
            top: 0;
            left: 0;
            background-size: cover;
            background-position: center center;
        }

        /* OTP form card styling */
        .loginbox {
            width: 460px;
            max-height: 520px;
            margin: 40px auto;
            padding: 30px 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.25);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-y: auto;
        }

        .loginbox h1 {
            text-align: center;
            color: #f44336;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 28px;
        }

        .loginbox p {
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
            margin-top: 12px;
            word-wrap: break-word;
        }

        .error-message {
            color: #b71c1c;
            font-weight: 700;
            margin-top: 10px;
            margin-bottom: 10px;
            text-align: center;
        }

        .loginbox input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        .loginbox input[type="text"]:focus {
            border-color: #f44336;
            outline: none;
            box-shadow: 0 0 8px rgba(244, 67, 54, 0.5);
        }

        .loginbox input[type="submit"] {
            width: 100%;
            background-color: #d32f2f;
            color: white;
            padding: 12px 0;
            font-weight: 700;
            font-size: 18px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            margin-top: 25px;
            transition: background-color 0.3s ease;
        }

        .loginbox input[type="submit"]:hover {
            background-color: #b71c1c;
        }

        /* Remove page scroll */
        html, body {
            overflow: hidden;
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="fullBackground"></div>

    <div class="loginbox">
        <h1>OTP Verification</h1>
        <p>Sent on Your Email id:&ensp;<strong><?php echo htmlspecialchars($email); ?></strong></p>

        <?php if($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <p>Enter OTP:</p>
            <input type="text" placeholder="Enter OTP" name="otp" required>
            <input type="submit" value="Next">
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="<?php echo BASE_URL; ?>modules/src/fullclip.js"></script>
    <script>
        $('.fullBackground').fullClip({
            images:[
                '<?php echo BASE_URL; ?>assets/img/1.jpg',
                '<?php echo BASE_URL; ?>assets/img/2.jpeg',
                '<?php echo BASE_URL; ?>assets/img/2.jpg',
                '<?php echo BASE_URL; ?>assets/img/3.jpg',
                '<?php echo BASE_URL; ?>assets/img/4.jpg',
                '<?php echo BASE_URL; ?>assets/img/5.jpg',
                '<?php echo BASE_URL; ?>assets/img/6.jpg',
                '<?php echo BASE_URL; ?>assets/img/7.jpg',
                '<?php echo BASE_URL; ?>assets/img/8.jpg',
                '<?php echo BASE_URL; ?>assets/img/9.jpg',
                '<?php echo BASE_URL; ?>assets/img/10.jpg'
            ],
            transitionTime: 2000,
            wait: 5000
        });  
    </script>
</body>
</html>
