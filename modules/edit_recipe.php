<?php
session_start();
include('../config.php');
include('../assets/php/connection.php');

if (!isset($_SESSION['id'])) {
    header("Location: " . BASE_URL . "modules/login.php");
    exit();
}

$userId = $_SESSION['id'];
$recipeId = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($recipeId <= 0) {
    die("Invalid recipe ID.");
}

$stmt = $conn->prepare("SELECT dname, cusine, course, recepie, description, videol, image FROM videos WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $recipeId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Recipe not found or permission denied.");
}

$recipe = $result->fetch_assoc();

$recepie = base64_decode($recipe['recepie']);
$description = base64_decode($recipe['description']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Recipe</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
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

        .edit-card {
            width: 480px;
            padding: 25px 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            position: relative;
            margin: 60px auto;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-height: 700px;
            overflow-y: auto;
        }

        .edit-card h2 {
            text-align: center;
            color: #f44336;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 28px;
        }

        .edit-card label {
            font-weight: 600;
            color: #333;
            display: block;
            margin-bottom: 6px;
            margin-top: 12px;
        }

        .edit-card input[type="text"],
        .edit-card select,
        .edit-card textarea,
        .edit-card input[type="file"] {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            resize: vertical;
        }

        .edit-card input[type="text"]:focus,
        .edit-card select:focus,
        .edit-card textarea:focus,
        .edit-card input[type="file"]:focus {
            border-color: #f44336;
            outline: none;
            box-shadow: 0 0 8px rgba(244, 67, 54, 0.5);
        }

        .edit-card video {
            width: 100%;
            max-height: 180px;
            margin-top: 8px;
            border-radius: 8px;
            background: #000;
        }

        .edit-card img {
            max-width: 100%;
            max-height: 150px;
            margin-top: 8px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #ccc;
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
    </style>
</head>

<body>

    <div class="fullBackground"></div>

    <div class="edit-card">
        <h2>Edit Recipe</h2>
        <form action="<?php echo BASE_URL; ?>assets/php/update_recipe.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $recipeId; ?>">
            <!-- Keep old video and image URLs for backend -->
            <input type="hidden" name="old_videol" value="<?php echo htmlspecialchars($recipe['videol']); ?>">
            <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($recipe['image']); ?>">

            <label for="dname">Dish Name</label>
            <input type="text" id="dname" name="dname" required value="<?php echo htmlspecialchars($recipe['dname']); ?>">

            <label for="cusine">Cuisine</label>
            <input type="text" id="cusine" name="cusine" required value="<?php echo htmlspecialchars($recipe['cusine']); ?>">

            <label for="course">Course</label>
            <input type="text" id="course" name="course" required value="<?php echo htmlspecialchars($recipe['course']); ?>">

            <label for="recepie">Recipe</label>
            <textarea id="recepie" name="recepie" rows="5" required><?php echo htmlspecialchars($recepie); ?></textarea>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3"><?php echo htmlspecialchars($description); ?></textarea>

            <label>Current Video</label>
            <?php if ($recipe['videol']): ?>
                <video controls>
                    <source src="<?php echo htmlspecialchars($recipe['videol']); ?>" type="video/mp4" />
                    Your browser does not support the video tag.
                </video>
            <?php else: ?>
                <p>No video uploaded.</p>
            <?php endif; ?>

            <label for="video">Replace Video (optional)</label>
            <input type="file" id="video" name="video" accept="video/*">

            <label>Current Image</label>
            <?php if ($recipe['image']): ?>
                <img src="<?php echo htmlspecialchars($recipe['image']); ?>" alt="Recipe Image" />
            <?php else: ?>
                <p>No image uploaded.</p>
            <?php endif; ?>

            <label for="image">Replace Image (optional)</label>
            <input type="file" id="image" name="image" accept="image/*">

            <div class="btn-group">
                <button type="submit" class="save-btn">Update</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='<?php echo BASE_URL; ?>modules/manage_recipes.php'">Cancel</button>
            </div>
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
