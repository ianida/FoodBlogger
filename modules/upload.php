<?php
ob_start();
session_start();

include_once('../config.php'); 

// Redirect if not logged in
if (!isset($_SESSION['fname'])) {
    header("Location: " . BASE_URL . "modules/login.php");
    exit;
}

include('navbar.php');
include('footer.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Upload</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/signup.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="<?php echo BASE_URL; ?>assets/js/upload.js"></script>
</head>

<body>
    <div class="fullBackground"></div>
    <div class="loginbox" style="width: 320px; height: 730px; top: 70%">
        <h1>Upload</h1>
        <form action="<?php echo BASE_URL; ?>assets/php/upload.php" method="post" enctype="multipart/form-data">
            <p>Name of the dish:</p>
            <input type="text" placeholder="Enter Name of the Dish" name="dname" required>

            <label for="cusine">Select Cusine:</label>
            <select id="cusine" name="cusine" style="background:black; color:white">
                <option value="Indian">Indian</option>
                <option value="Chinese">Chinese</option>
                <option value="Italian">Italian</option>
            </select>
            <br><br>

            <label for="course">Select Course:</label>
            <select id="course" name="course" style="background:black; color:white">
                <option value="Starter">Starter</option>
                <option value="MainCourse">Main Course</option>
                <option value="Desert">Desert</option>
                <option value="Snacks">Snacks</option>
            </select>
            <br><br>

            <p>Select Video:</p>
            <input type="file" name="video" accept="video/*" required>
            <br>

            <p>Cover Image:</p>
            <input type="file" name="image" accept="image/*">
            <br>

            <p>Recepie:</p>
            <textarea style="height: 70px; width:250px; text-align:center;" placeholder="Enter your Recepie..." name="recepie" required></textarea>
            <br><br>

            <p>Description:</p>
            <textarea style="height: 70px; width:250px; text-align:center;" placeholder="Enter Description" name="description"></textarea>
            <br><br>

            <input type="submit" value="Upload">
            <br>
        </form>

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="<?php echo BASE_URL; ?>modules/src/fullclip.js"></script>
        <script>
            $('.fullBackground').fullClip({
                images: [
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
    </div>
</body>

</html>