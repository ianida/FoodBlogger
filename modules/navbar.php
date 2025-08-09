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
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <style>
        /* Navbar background with subtle shadow */
.navbar-dark.bg-dark {
  background: linear-gradient(90deg, #1c1c1c, #2a2a2a);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
}

/* Smooth hover effect for nav links */
.navbar-nav .nav-link {
  transition: color 0.3s ease, background-color 0.3s ease;
}

.navbar-nav .nav-link:hover, 
.navbar-nav .nav-item.active .nav-link {
  color: #f44336; /* bright red accent */
  background-color: rgba(255, 255, 255, 0.1);
  border-radius: 4px;
}

/* Dropdown menu rounded with subtle shadow */
.dropdown-menu {
  border-radius: 6px;
  box-shadow: 0 6px 12px rgba(0,0,0,0.15);
  border: none;
}

/* Dropdown items hover */
.dropdown-menu .dropdown-item:hover {
  background-color: #f44336;
  color: white;
}

/* Search input styling */
.navbar .form-control {
  border-radius: 20px 0 0 20px;
  border: 1px solid #ccc;
  transition: border-color 0.3s ease;
}

.navbar .form-control:focus {
  border-color: #f44336;
  box-shadow: 0 0 8px rgba(244, 67, 54, 0.6);
  outline: none;
}

/* Search button rounded right */
.navbar .input-group-append .btn {
  border-radius: 0 20px 20px 0;
  border-color: #f44336;
  background-color: transparent;
  color: #f44336;
  transition: background-color 0.3s ease, color 0.3s ease;
}

.navbar .input-group-append .btn:hover {
  background-color: #f44336;
  color: white;
}

/* Greeting text style */
#nam {
  font-weight: 600;
  color: #fff;
  font-size: 1.1rem;
  margin-right: 10px;
}

    </style>

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
        <button class="navbar-toggler mx-auto" data-toggle="collapse" data-target="#collapse_target">
            <span class="navbar-toggler-icon align-center"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapse_target">
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="dropdown_target" href="#">Cuisine<span class="caret"></span></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown_target">
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>assets/php/search.php?cusinav=indian">Indian</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>assets/php/search.php?cusinav=italian">Italian</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>assets/php/search.php?cusinav=chinese">Chinese</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="dropdown_target" href="#">Course<span class="caret"></span></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown_target">
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>assets/php/search.php?navval=starter">Starter</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>assets/php/search.php?navval=maincourse">Main Course</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>assets/php/search.php?navval=desert">Desert</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>assets/php/search.php?navval=snacks">Snacks</a>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>modules/upload.php">Upload</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>index.php?#indexbox">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>contact.php?#indexbox">Contact Us</a>
                </li>
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
                    $user = new \stdClass();
                    $user->fname = $_SESSION['fname'];
                    $user->lname = $_SESSION['lname'];
                    $user->email = $_SESSION['emailid'];
                    $user->phone = $_SESSION['phone'];
                    $ename = json_encode($user->fname);
                    $ename = preg_replace('~"~', '', $ename);
                ?>
                    <li class="nav-item">
                        <span class="navbar-text m-2" id="nam"><?php echo "Hello ", $ename ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link m-2" href="<?php echo BASE_URL; ?>modules/logout.php">Logout</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link m-2" href="<?php echo BASE_URL; ?>modules/signup.php">Signup</a></li>
                    <li class="nav-item m-2">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>modules/login.php">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</body>

</html>