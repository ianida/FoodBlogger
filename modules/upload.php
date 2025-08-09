<?php
ob_start();
session_start();

include_once('../config.php'); 

// Redirect if not logged in
if (!isset($_SESSION['fname'])) {
    header("Location: " . BASE_URL . "modules/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Upload</title>
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


        .loginbox h1 {
            text-align: center;
            color: #f44336;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 28px;
        }

        .loginbox p, .loginbox label {
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
            margin-top: 12px;
            display: block;
        }

        /* Inputs and selects */
        .loginbox input[type="text"],
        .loginbox input[type="file"],
        .loginbox select,
        .loginbox textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
            font-family: inherit;
            resize: vertical;
        }

        .loginbox input[type="text"]:focus,
        .loginbox input[type="file"]:focus,
        .loginbox select:focus,
        .loginbox textarea:focus {
            border-color: #f44336;
            outline: none;
            box-shadow: 0 0 8px rgba(244, 67, 54, 0.5);
        }

        /* Textarea specific */
        .loginbox textarea {
            min-height: 70px;
            text-align: left;
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

        /* Scrollbar inside form */
        .loginbox::-webkit-scrollbar {
            width: 6px;
        }
        .loginbox::-webkit-scrollbar-thumb {
            background-color: rgba(244, 67, 54, 0.5);
            border-radius: 3px;
        }

        /* Prevent page scrollbar */
        html, body {
            overflow: hidden;
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>

    <script src="<?php echo BASE_URL; ?>assets/js/upload.js"></script>
</head>

<body>
    <?php include(__DIR__ . '/navbar.php'); ?>

    <div class="fullBackground"></div>

    <div class="loginbox">
        <h1>Upload</h1>
        <form action="<?php echo BASE_URL; ?>assets/php/upload.php" method="post" enctype="multipart/form-data">
            <p>Name of the dish:</p>
            <input type="text" placeholder="Enter Name of the Dish" name="dname" required>

            <label for="cusine">Select Cuisine:</label>
            <select id="cusine" name="cusine" required>
                <option value="" disabled selected>-- Select Cuisine --</option>
                <option value="Indian">Indian</option>
                <option value="Chinese">Chinese</option>
                <option value="Italian">Italian</option>
            </select>

            <label for="course">Select Course:</label>
            <select id="course" name="course" required>
                <option value="" disabled selected>-- Select Course --</option>
                <option value="Starter">Starter</option>
                <option value="MainCourse">Main Course</option>
                <option value="Desert">Desert</option>
                <option value="Snacks">Snacks</option>
            </select>

            <p>Select Video:</p>
            <input type="file" name="video" accept="video/*" required>

            <p>Cover Image:</p>
            <input type="file" name="image" accept="image/*">

            <p>Recipe:</p>
            <textarea placeholder="Enter your Recipe..." name="recepie" required></textarea>

            <p>Description:</p>
            <textarea placeholder="Enter Description" name="description"></textarea>

            <input type="submit" value="Upload">
        </form>
    </div>

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
</body>

</html>
