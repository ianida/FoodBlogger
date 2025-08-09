<?php
session_start();
include_once(__DIR__ . '/../config.php');

// Redirect if not logged in
if (!isset($_SESSION['fname'])) {
    header("Location: " . BASE_URL . "modules/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manage Profile - FoodBlogger</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />

    <!-- FontAwesome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <style>
        body {
            background: #f5f5f5;
            margin: 0;
        }

        .container {
            margin-top: 70px;
            background: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #f44336;
            margin-bottom: 30px;
            font-weight: 700;
        }
    </style>

</head>

<body>
    <?php include(__DIR__ . '/navbar.php'); ?>

    <?php if (isset($_GET['update']) && $_GET['update'] === 'success'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" 
             style="position: fixed; top: 80px; right: 20px; z-index: 1050; min-width: 250px;">
            <strong>Success!</strong> Your profile has been updated.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="outline:none;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $('.alert-success').fadeOut('slow');
                }, 4000);
            });
        </script>
    <?php endif; ?>

    <div class="container">
        <h1>Manage Your Profile</h1>

        <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['fname'] . ' ' . $_SESSION['lname']); ?></strong></p>

        <!-- Profile management form or info here -->
        <p>You can update your profile details here.</p>

        <a href="<?php echo BASE_URL; ?>modules/edit_profile.php" class="btn btn-danger">
            <i class="fa fa-pencil"></i> Edit Profile
        </a>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>
