<!-- <?php //session_start(); 
//$email=$_SESSION['email'];
?>
<html>
	<head>
		<title>Forgot</title>
        <link rel="stylesheet" href="../assets/css/signup.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script ></script>
       
       
    </head>
	<body >
        <div class="fullBackground"></div>
        <div class="loginbox" style="width: 380px;height: 380px;top:50%;">
            <h1>Sign up</h1>
            <form action="../assets/php/forgot0.php" method="post">
                <p>Sent on Your Email id:&ensp;<?php //echo $email;?></p>
                <br>
                <br>
                <p>Enter OTP:</p>
                <input type="text" placeholder="Enter OTP" name="otp" required>
                <input type='submit' id="subbtn" value="Next">
            </form>
            <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
            <script src="src/fullclip.js"></script>
             <script >
              $('.fullBackground').fullClip({
                    images:['../assets/img/1.jpg','../assets/img/2.jpeg','../assets/img/2.jpg','../assets/img/3.jpg','../assets/img/4.jpg','../assets/img/5.jpg','../assets/img/6.jpg','../assets/img/7.jpg','../assets/img/8.jpg','../assets/img/9.jpg','../assets/img/10.jpg'],
                    transitionTime:2000,
                    wait:5000
                });  

            </script>
        </div>
        
    </body>
</html> -->


<?php 
session_start();
include_once('../config.php');  

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
?>
<html>
<head>
    <title>Forgot OTP</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/signup.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="fullBackground"></div>
    <div class="loginbox" style="width: 380px;height: 380px;top:50%;">
        <h1>OTP Verification</h1>
        <form action="<?php echo BASE_URL; ?>assets/php/forgot0.php" method="post">
            <p>Sent on Your Email id:&ensp;<?php echo htmlspecialchars($email); ?></p>
            <br><br>
            <p>Enter OTP:</p>
            <input type="text" placeholder="Enter OTP" name="otp" required>
            <input type='submit' id="subbtn" value="Next">
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
