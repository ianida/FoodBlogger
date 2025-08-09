<?php
session_start();
if (!isset($_SESSION['fname']) || !isset($_SESSION['id'])) {
    header("Location: " . BASE_URL . "modules/login.php");
    exit();
}

include_once(__DIR__ . '/../assets/php/connection.php');

$userId = $_SESSION['id'];

$sql = "SELECT id, dname, cusine, course, image FROM videos WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Recipes - FoodBlogger</title>
  
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" /> -->

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card {
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.2s ease;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
    .card-img-top {
      height: 180px;
      object-fit: cover;
      border-bottom: 1px solid #ddd;
    }
    .card-title {
      font-weight: 600;
      font-size: 1.25rem;
    }
    .card-text {
      color: #555;
      font-size: 0.9rem;
    }
    .btn-group {
      width: 100%;
    }
    .btn-group .btn {
      flex: 1;
      font-weight: 600;
    }
    .no-recipes {
      color: #666;
      font-size: 1.1rem;
      margin-top: 30px;
      text-align: center;
    }
  </style>
</head>
<body>
  <?php include(__DIR__ . '/navbar.php'); ?>

  <div class="container mt-5">
    <h1 class="mb-4 text-center">Your Recipes</h1>

    <?php if ($result->num_rows === 0): ?>
      <p class="no-recipes">You have not posted any recipes yet.</p>
    <?php else: ?>
      <div class="row">
        <?php while ($recipe = $result->fetch_assoc()): ?>
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card">
              <?php if ($recipe['image']): ?>
                <img src="<?php echo htmlspecialchars($recipe['image']); ?>" class="card-img-top" alt="Recipe Image">
              <?php else: ?>
                <img src="<?php echo BASE_URL; ?>assets/img/default-recipe.png" class="card-img-top" alt="Default Image">
              <?php endif; ?>

              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?php echo htmlspecialchars($recipe['dname']); ?></h5>
                <p class="card-text mb-1"><strong>Cuisine:</strong> <?php echo htmlspecialchars($recipe['cusine']); ?></p>
                <p class="card-text mb-3"><strong>Course:</strong> <?php echo htmlspecialchars($recipe['course']); ?></p>

                <div class="btn-group mt-auto" role="group">
                    <a href="<?php echo BASE_URL . 'modules/edit_recipe.php?id=' . $recipe['id']; ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                        Edit
                    </a>
                    <a href="<?php echo BASE_URL . 'modules/delete_recipe.php?id=' . $recipe['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this recipe?');" title="Delete">
                        Delete
                    </a>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- FontAwesome for icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
</body>
</html>
