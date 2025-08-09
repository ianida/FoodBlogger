<?php
session_start();
include('../config.php');  // go one folder up to root to include config.php

// Check if user is logged in and is admin
if (!isset($_SESSION['id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: " . BASE_URL . "modules/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Dashboard</title>
<style>
  /* Reset some default styles */
  * {
    box-sizing: border-box;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f5f7fa;
    margin: 0;
    padding: 0;
    display: flex;
    min-height: 100vh;
    justify-content: center;
    align-items: center;
  }

  .dashboard-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    padding: 40px 60px;
    max-width: 400px;
    width: 100%;
    text-align: center;
  }

  h1 {
    margin-bottom: 20px;
    color: #333;
    font-weight: 700;
    font-size: 28px;
  }

  .welcome-text {
    font-size: 16px;
    color: #555;
    margin-bottom: 30px;
  }

  .btn {
    display: block;
    background: #4a90e2;
    color: white;
    text-decoration: none;
    padding: 14px 0;
    border-radius: 8px;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    box-shadow: 0 5px 10px rgba(74,144,226,0.4);
    transition: background-color 0.3s ease;
  }

  .btn:hover {
    background: #357ABD;
    box-shadow: 0 7px 15px rgba(53,122,189,0.6);
  }

  .btn.logout {
    background: #e94e4e;
    box-shadow: 0 5px 10px rgba(233,78,78,0.4);
  }

  .btn.logout:hover {
    background: #b82c2c;
    box-shadow: 0 7px 15px rgba(184,44,44,0.6);
  }
</style>
</head>
<body>

<div class="dashboard-container">
    <h1>Admin Dashboard</h1>
    <div class="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION['fname']); ?>!</div>

    <a href="<?php echo BASE_URL; ?>admin/admin_users.php" class="btn">Manage Users</a>
    <a href="<?php echo BASE_URL; ?>admin/admin_logout.php" class="btn logout">Logout</a>
</div>

</body>
</html>
