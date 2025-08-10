<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once(__DIR__ . '/../config.php');
echo '<!-- BASE_URL: ' . BASE_URL . ' -->';
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <style>
/* Lighter navbar background */
.navbar-light.bg-light {
  background: linear-gradient(90deg, #f9f9f9, #eaeaea);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

/* Light text color with subtle accent */
.navbar-light .navbar-nav .nav-link {
  color: #444;
  transition: color 0.3s ease, background-color 0.3s ease;
}
.navbar-light .navbar-nav .nav-link:hover,
.navbar-light .navbar-nav .nav-item.active .nav-link {
  color: #ff5722; /* warm orange accent */
  background-color: rgba(255, 87, 34, 0.1);
  border-radius: 4px;
}

/* Dropdown menu */
.dropdown-menu {
  border-radius: 6px;
  box-shadow: 0 6px 12px rgba(0,0,0,0.15);
  border: none;
}
.dropdown-menu .dropdown-item:hover {
  background-color: #ff5722;
  color: white;
}

/* Search input */
.navbar .form-control {
  border-radius: 20px 0 0 20px;
  border: 1px solid #ccc;
}
.navbar .form-control:focus {
  border-color: #ff5722;
  box-shadow: 0 0 8px rgba(255, 87, 34, 0.6);
  outline: none;
}

/* Search button */
.navbar .input-group-append .btn {
  border-radius: 0 20px 20px 0;
  border-color: #ff5722;
  background-color: transparent;
  color: #ff5722;
  transition: 0.3s;
}
.navbar .input-group-append .btn:hover {
  background-color: #ff5722;
  color: white;
}

/* Greeting text */
#nam {
  font-weight: 600;
  color: #444;
  font-size: 1.1rem;
  margin-right: 10px;
}

/* Icon colors */
.fa {
  color: #ff5722;
}
    </style>
</head>

<body>
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
    <button class="navbar-toggler mx-auto" data-toggle="collapse" data-target="#collapse_target">
        <span class="navbar-toggler-icon align-center"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapse_target">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php"><i class="fa fa-home"></i> Home</a></li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-cutlery"></i> Cuisine</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>assets/php/search.php?cusinav=nepali">Nepali</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>assets/php/search.php?cusinav=italian">Italian</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>assets/php/search.php?cusinav=chinese">Chinese</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>assets/php/search.php?cusinav=indian">Indian</a>    
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-list"></i> Course</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>assets/php/search.php?navval=starter">Starter</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>assets/php/search.php?navval=maincourse">Main Course</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>assets/php/search.php?navval=desert">Desert</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>assets/php/search.php?navval=snacks">Snacks</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>modules/upload.php"><i class="fa fa-upload"></i> Upload</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?#indexbox"><i class="fa fa-info-circle"></i> About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>contact.php?#indexbox"><i class="fa fa-envelope"></i> Contact Us</a></li>
        </ul>

        <ul class="navbar-nav">
            <form class="navbar-form align-self-center" action="<?php echo BASE_URL; ?>assets/php/search.php" method="GET">
                <div class="input-group p-2">
                    <input type="text" class="form-control" placeholder="Search" name="search" id="search">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit" name="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            
            <?php if (isset($_SESSION['fname'])) {
                $ename = htmlspecialchars($_SESSION['fname']);
            ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle m-2" href="#" id="userDropdown" data-toggle="dropdown">
                        <i class="fa fa-user"></i> Hello, <?php echo $ename; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>modules/manage_profile.php">Manage Profile</a>
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>modules/manage_recipes.php">Manage Recipes</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>modules/logout.php">Logout</a>
                    </div>
                </li>
            <?php } else { ?>
                <li class="nav-item"><a class="nav-link m-2" href="<?php echo BASE_URL; ?>modules/signup.php"><i class="fa fa-user-plus"></i> Signup</a></li>
                <li class="nav-item m-2"><a class="nav-link" href="<?php echo BASE_URL; ?>modules/login.php"><i class="fa fa-sign-in"></i> Login</a></li>
            <?php } ?>
        </ul>
    </div>
</nav>
</body>
</html>
