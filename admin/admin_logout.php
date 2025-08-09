<?php
session_start();
session_destroy();

include_once('../config.php');  // Add this line to include BASE_URL

header("Location: " . BASE_URL . "modules/login.php");
exit();
