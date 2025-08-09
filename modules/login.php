<?php
include_once('../config.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/login.css" type="text/css">
</head>
<body>
    <?php include(__DIR__ . '/../modules/navbar.php'); ?>
    
    <section>
        <div class="fullBackground"></div>
        <div class="loginbox">
            <h1>Login Here</h1>
            <form onsubmit="return checkForm(this);" action="<?php echo BASE_URL; ?>assets/php/login.php" method="post">
                <p>Email id:</p>
                <input type="email" placeholder="Enter your email" name="email" required>
                <p>Password:</p>
                <input type="password" placeholder="Enter Password" name="password" id="pass" required><br><br>
                <input type="submit" value="Login"><br>
                <a href="<?php echo BASE_URL; ?>modules/forgot.php">Forgot Password</a><br>
                <a href="<?php echo BASE_URL; ?>modules/signup.php">I'm new here</a>
            </form>
        </div>
    </section>

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
