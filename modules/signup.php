<?php
include_once('../config.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/signup.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
    <?php include(__DIR__ . '/navbar.php'); ?>

    <div class="fullBackground"></div>
    <div class="loginbox" style="width: 350px; height: 950px; top: 90%">
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
            <p>Gender:</p><br>
            <p>Male:<input type="radio" name="gender" value="m" required></p>
            <p>Female:<input type="radio" name="gender" value="f" required></p>
            <p>Other:<input type="radio" name="gender" value="o" required></p><br>
            <p style="display:inline">Captcha:</p>
            <div class="g-recaptcha" data-sitekey="6Ld7mXQUAAAAANA3hCCd13QCQ0roGL_V6vQ-k6xG"></div>
            <br><br>

            <input type="submit" id="submit" name="submit"><br>
            <a href="<?php echo BASE_URL; ?>modules/login.php">Already a user</a>
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

    <?php require(__DIR__ . '/footer.php'); ?>
</body>
</html>
