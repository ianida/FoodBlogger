<?php
include_once('../config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign up</title>
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

        /* Signup card styling similar to edit_profile */
        .loginbox {
    position: fixed;
    top: 90px; 
    left: 50%;
    transform: translateX(-50%);
    width: 460px;
    max-height: calc(100vh - 140px);
    padding: 30px 40px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    overflow-y: auto;
    z-index: 1000;
}

/* Scrollbar inside form */
.loginbox::-webkit-scrollbar {
    width: 6px;
}
.loginbox::-webkit-scrollbar-thumb {
    background-color: rgba(244, 67, 54, 0.5);
    border-radius: 3px;
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
        }

        .loginbox input[type="text"],
        .loginbox input[type="email"],
        .loginbox input[type="date"],
        .loginbox input[type="tel"],
        .loginbox select {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        .loginbox input[type="text"]:focus,
        .loginbox input[type="email"]:focus,
        .loginbox input[type="date"]:focus,
        .loginbox input[type="tel"]:focus,
        .loginbox select:focus {
            border-color: #f44336;
            outline: none;
            box-shadow: 0 0 8px rgba(244, 67, 54, 0.5);
        }

        /* Radio buttons styling container */
        .gender-options p {
            display: inline-block;
            margin-right: 15px;
            font-weight: 600;
            color: #333;
        }
        .gender-options input[type="radio"] {
            margin-left: 5px;
            vertical-align: middle;
        }

        /* Submit button */
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

        /* Captcha label and box alignment */
        .captcha-container {
            display: flex;
            align-items: center;
            margin-top: 15px;
            margin-bottom: 20px;
        }
        .captcha-container p {
            margin: 0 10px 0 0;
            font-weight: 600;
            color: #333;
            white-space: nowrap;
        }

        /* Link styling */
        .loginbox a {
            display: block;
            margin-top: 12px;
            color: #f44336;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            transition: color 0.3s ease;
        }
        .loginbox a:hover {
            color: #b71c1c;
            text-decoration: underline;
        }

        /* Prevent page scrollbar */
        html, body {
            overflow: hidden;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        /* Fix navbar search box color override on this page */
        <?php /* Assuming navbar search input uses class .search-input */ ?>
        .search-input {
            background-color: white !important;
            color: black !important;
        }
    </style>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <?php include(__DIR__ . '/navbar.php'); ?>

    <div class="fullBackground"></div>

    <div class="loginbox">
        <h1>Sign up</h1>
        <form action="<?php echo BASE_URL; ?>assets/php/signup.php" method="post" onsubmit="return checkForm(this);">
            <p>First Name:</p>
            <input type="text" placeholder="Enter First Name" name="fname" required>

            <p>Last Name:</p>
            <input type="text" placeholder="Enter Last Name" name="lname" required>

            <p>Email id:</p>
            <input type="email" placeholder="Enter email" name="emailid" required>

            <p>Date Of Birth:</p>
            <input type="date" id="dob" name="dob" required>

            <p>Contact Number:</p>
            <input type="tel" placeholder="Enter your phone number here" id="phone" name="phone" required>

            <p>Gender:</p>
            <div class="gender-options">
                <p>Male:<input type="radio" name="gender" value="m" required></p>
                <p>Female:<input type="radio" name="gender" value="f" required></p>
                <p>Other:<input type="radio" name="gender" value="o" required></p>
            </div>

            <p>Role:</p>
            <select name="role" required>
                <option value="user" selected>User</option>
                <option value="admin">Admin</option>
            </select>

            <div class="captcha-container">
                <p>Captcha:</p>
                <div class="g-recaptcha" data-sitekey="6Ld7mXQUAAAAANA3hCCd13QCQ0roGL_V6vQ-k6xG"></div>
            </div>

            <input type="submit" id="submit" name="submit">

            <a href="<?php echo BASE_URL; ?>modules/login.php">Already a user?</a>
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

    <!-- <?php //require(__DIR__ . '/footer.php'); ?> -->
</body>
</html>
