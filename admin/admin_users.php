<?php
session_start();
include('../config.php');
include('../assets/php/connection.php');

// Check admin role
if (!isset($_SESSION['id']) || ($_SESSION['role'] ?? '') !== 'admin') {
  header("Location: " . BASE_URL . "modules/login.php");
  exit();
}

// Handle Add User
if (isset($_POST['add_user'])) {
  $fname = $_POST['fname'] ?? '';
  $lname = $_POST['lname'] ?? '';
  $email = $_POST['email'] ?? '';
  $phone = $_POST['phone'] ?? '';
  $role = $_POST['role'] ?? 'user';
  $password = $_POST['password'] ?? '';

  if ($fname && $email && $password) {
    $stmt = $conn->prepare("INSERT INTO signup (fname, lname, email, phone, role, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fname, $lname, $email, $phone, $role, $password);
    $stmt->execute();
    $stmt->close();
    header("Location: admin_users.php");
    exit();
  } else {
    $error = "First name, email, and password are required.";
  }
}

// Handle Delete User
if (isset($_GET['delete'])) {
  $del_id = intval($_GET['delete']);
  $stmt = $conn->prepare("DELETE FROM signup WHERE id = ?");
  $stmt->bind_param("i", $del_id);
  $stmt->execute();
  $stmt->close();
  header("Location: admin_users.php");
  exit();
}

// Handle Edit User
$edit_user = null;
if (isset($_GET['edit'])) {
  $edit_id = intval($_GET['edit']);
  $stmt = $conn->prepare("SELECT * FROM signup WHERE id = ?");
  $stmt->bind_param("i", $edit_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $edit_user = $result->fetch_assoc();
  $stmt->close();
}

// Handle Update User
if (isset($_POST['update_user'])) {
  $id = intval($_POST['id']);
  $fname = $_POST['fname'] ?? '';
  $lname = $_POST['lname'] ?? '';
  $email = $_POST['email'] ?? '';
  $phone = $_POST['phone'] ?? '';
  $role = $_POST['role'] ?? 'user';

  if ($fname && $email) {
    $stmt = $conn->prepare("UPDATE signup SET fname=?, lname=?, email=?, phone=?, role=? WHERE id=?");
    $stmt->bind_param("sssssi", $fname, $lname, $email, $phone, $role, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin_users.php");
    exit();
  } else {
    $error = "First name and email required.";
  }
}

// Fetch all users
$users = $conn->query("SELECT * FROM signup ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Users</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f2f5;
      margin: 0;
      padding: 30px 15px;
      color: #333;
    }

    .container {
      max-width: 960px;
      margin: 0 auto;
      background: #fff;
      border-radius: 10px;
      padding: 30px 40px;
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    h1,
    h2 {
      font-weight: 700;
      color: #222;
      margin-bottom: 25px;
    }

    a {
      color: #d32f2f;
      text-decoration: none;
      font-weight: 600;
    }

    a:hover {
      text-decoration: underline;
    }

    .top-links {
      margin-bottom: 25px;
    }

    .top-links a {
      margin-right: 20px;
    }

    .error {
      background-color: #ffe0e0;
      color: #d8000c;
      padding: 12px 15px;
      margin-bottom: 20px;
      border-radius: 6px;
      border: 1px solid #d8000c;
    }

    form {
      margin-bottom: 30px;
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      align-items: center;
    }

    input[type=text],
    input[type=email],
    input[type=password],
    select {
      padding: 10px 14px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
      width: 220px;
      transition: border-color 0.3s ease;
    }

    input[type=text]:focus,
    input[type=email]:focus,
    input[type=password]:focus,
    select:focus {
      border-color: #d32f2f;
      outline: none;
    }

    input[type=submit] {
      background: #d32f2f;
      color: white;
      border: none;
      padding: 12px 26px;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 700;
      box-shadow: 0 6px 12px rgba(211, 47, 47, 0.5);
      transition: background-color 0.3s ease;
    }

    input[type=submit]:hover {
      background: #9b1c1c;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
      border-radius: 10px;
      overflow: hidden;
    }

    th,
    td {
      padding: 12px 18px;
      text-align: left;
    }

    thead {
      background: #d32f2f;
      color: white;
      font-weight: 600;
    }

    tbody tr {
      border-bottom: 1px solid #eee;
      transition: background-color 0.2s ease;
    }

    tbody tr:hover {
      background-color: #ffe5e5;
    }

    tbody td a {
      font-weight: 600;
    }

    tbody td a[href*="edit"] {
      color: #4a90e2;
    }

    tbody td a[href*="edit"]:hover {
      text-decoration: underline;
      color: #357ABD;
    }

    tbody td a[href*="delete"] {
      color: #d32f2f;
    }

    tbody td a[href*="delete"]:hover {
      color: #9b1c1c;
    }


    .actions a {
      margin-right: 12px;
    }

    /* Responsive */
    @media(max-width: 700px) {

      form input[type=text],
      form input[type=email],
      form input[type=password],
      form select {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <div class="container">

    <h1>Manage Users</h1>

    <div class="top-links">
      <a href="index.php">← Admin Dashboard</a>
      <!-- Removed logout link here -->
    </div>

    <?php if (!empty($error)): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if ($edit_user): ?>
      <h2>Edit User #<?php echo $edit_user['id']; ?></h2>
      <form method="post" action="admin_users.php">
        <input type="hidden" name="id" value="<?php echo $edit_user['id']; ?>">
        <input type="text" name="fname" value="<?php echo htmlspecialchars($edit_user['fname']); ?>" placeholder="First Name" required>
        <input type="text" name="lname" value="<?php echo htmlspecialchars($edit_user['lname']); ?>" placeholder="Last Name">
        <input type="email" name="email" value="<?php echo htmlspecialchars($edit_user['email']); ?>" placeholder="Email" required>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($edit_user['phone']); ?>" placeholder="Phone">
        <select name="role">
          <option value="user" <?php if ($edit_user['role'] === 'user') echo 'selected'; ?>>User</option>
          <option value="admin" <?php if ($edit_user['role'] === 'admin') echo 'selected'; ?>>Admin</option>
        </select>
        <input type="submit" name="update_user" value="Update User">
      </form>
    <?php else: ?>
      <h2>Add New User</h2>
      <form method="post" action="admin_users.php">
        <input type="text" name="fname" placeholder="First Name" required>
        <input type="text" name="lname" placeholder="Last Name">
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone">
        <select name="role">
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" name="add_user" value="Add User">
      </form>
    <?php endif; ?>

    <h2>All Users</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Role</th>
          <th style="width:130px;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $users->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['fname']); ?></td>
            <td><?php echo htmlspecialchars($row['lname']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['phone']); ?></td>
            <td><?php echo htmlspecialchars($row['role']); ?></td>
            <td class="actions">
              <a href="admin_users.php?edit=<?php echo $row['id']; ?>">Edit</a>
              <a href="admin_users.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete user?');" style="color:#e94e4e;">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>

</html>
