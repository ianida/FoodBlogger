<?php
session_start();
// Include config and connection if needed
include('../config.php');
include('../assets/php/connection.php');

// Fetch user data from session or DB to prefill form (example)
$fname = $_SESSION['fname'] ?? '';
$lname = $_SESSION['lname'] ?? '';
$email = $_SESSION['emailid'] ?? '';
$phone = $_SESSION['phone'] ?? '';
$dob = $_SESSION['dob'] ?? '';
$gender = $_SESSION['gender'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Profile</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSS -->
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

        /* Fix margin/padding on html, body */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        .edit-card {
            position: fixed;
            top: 90px;
            bottom: 70px; /* space from bottom */
            left: 50%;
            transform: translateX(-50%);
            width: 460px;
            padding: 30px 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-y: auto;
            z-index: 1000;
            box-sizing: border-box; /* include padding in width/height */
        }

        .edit-card h2 {
            text-align: center;
            color: #f44336;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 28px;
            box-shadow: none;
        }

        .edit-card label {
            font-weight: 600;
            color: #333;
            display: block;
            margin-bottom: 6px;
            margin-top: 12px;
        }

        .edit-card input[type="text"],
        .edit-card input[type="email"],
        .edit-card input[type="date"],
        .edit-card input[type="tel"] {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        .edit-card input[type="text"]:focus,
        .edit-card input[type="email"]:focus,
        .edit-card input[type="date"]:focus,
        .edit-card input[type="tel"]:focus {
            border-color: #f44336;
            outline: none;
            box-shadow: 0 0 8px rgba(244, 67, 54, 0.5);
        }

        .edit-card .btn-group {
            margin-top: 30px;
            text-align: center;
        }

        .edit-card button.save-btn {
            background-color: #d32f2f;
            color: white;
            padding: 10px 40px;
            border-radius: 20px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 0 10px;
        }

        .edit-card button.save-btn:hover {
            background-color: #b71c1c;
        }

        .edit-card button.cancel-btn {
            background-color: #777;
            color: white;
            padding: 10px 40px;
            border-radius: 20px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            margin: 0 10px;
        }

        .edit-card button.cancel-btn:hover {
            background-color: #555;
        }

        /* Scrollbar inside form */
        .edit-card::-webkit-scrollbar {
            width: 6px;
        }

        .edit-card::-webkit-scrollbar-thumb {
            background-color: rgba(244, 67, 54, 0.5);
            border-radius: 3px;
        }
    </style>
</head>

<body>

    <div class="fullBackground"></div>

    <div class="edit-card">
        <h2>Edit Profile</h2>
        <form action="<?php echo BASE_URL; ?>assets/php/update_profile.php" method="POST">
            <label for="fname">First Name</label>
            <input type="text" name="fname" id="fname" required value="<?php echo htmlspecialchars($fname); ?>">

            <label for="lname">Last Name</label>
            <input type="text" name="lname" id="lname" required value="<?php echo htmlspecialchars($lname); ?>">

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required value="<?php echo htmlspecialchars($email); ?>" readonly>

            <label for="phone">Phone</label>
            <input type="tel" name="phone" id="phone" required value="<?php echo htmlspecialchars($phone); ?>">

            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" required value="<?php echo htmlspecialchars($dob); ?>">

            <label for="gender">Gender</label>
            <input type="text" name="gender" id="gender" required value="<?php echo htmlspecialchars($gender); ?>">

            <div class="btn-group">
                <button type="submit" class="save-btn">Update</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='<?php echo BASE_URL; ?>modules/manage_profile.php'">Cancel</button>
            </div>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- Fullclip script for background slideshow -->
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
