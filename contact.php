<!-- <html>
    <body>
        <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.687940110772!2d85.31228231450104!3d27.71724578280142!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb190bb873dcdf%3A0x4e3a99a6785b3c8d!2sKathmandu%2C%20Nepal!5e0!3m2!1sen!2snp!4v1689245625829!5m2!1sen!2snp" 
      allowfullscreen 
      loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade"
      >
    </iframe>
        <h1>Phone no. 9841123456</h1>
        <h1>Emailid:abc@gmail.com</h1>
    </body>    
</html>     -->




<?php
session_start();
include_once(__DIR__ . '/modules/navbar.php');  // Include your navbar here
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contact Us</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        /* Reset body margin and padding */
        body {
            background: #f9f9f9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Fix navbar on top */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1030;
            margin: 0;
        }

        /* Contact card container */
        .contact-container {
            max-width: 900px;
            /* Increased width */
            margin: 100px auto 40px;
            /* margin-top to clear navbar */
            background: white;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        iframe {
            border-radius: 8px;
            width: 100%;
            height: 350px;
            border: none;
            margin-bottom: 20px;
        }

        h1,
        h5 {
            color: #333;
            margin-bottom: 15px;
        }

        .contact-info {
            margin-top: 10px;
            text-align: center;
        }

        .contact-info h5 {
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="contact-container">
        <h1 class="text-center">Contact Us</h1>

        <!-- Google Map iframe centered on your location -->
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.687940110772!2d85.31228231450104!3d27.71724578280142!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb190bb873dcdf%3A0x4e3a99a6785b3c8d!2sKathmandu%2C%20Nepal!5e0!3m2!1sen!2snp!4v1689245625829!5m2!1sen!2snp"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>

        <div class="contact-info">
            <h5>Phone: <a href="tel:+9779841123456">+977 9841123456</a></h5>
            <h5>Email: <a href="mailto:abc@gmail.com">abc@gmail.com</a></h5>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>