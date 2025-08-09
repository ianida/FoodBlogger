<?php 
include_once('../config.php');  
include('navbar.php');
?>
<html>
<head>
    <title>Forgot</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/signup.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="<?php echo BASE_URL; ?>modules/src/fullclip.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
</head>
<body>
    <div class="fullBackground"></div>
    <div class="loginbox" style="width: 320px;height: 300px;top:50%">
        <h1>Forgot Password</h1>
        <form action="<?php echo BASE_URL; ?>assets/php/forgot.php" method="post" onsubmit="return checkForm(this);">
            <p>Enter your Email-Id</p>
            <input type="email" placeholder="Enter your emailid" name="email" required>
            <input type='submit' id="subbtn">
        </form>
    </div>
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
            transitionTime:2000,
            wait:5000
        });  
    </script>
</body>
<?php include('footer.php'); ?>
</html>
