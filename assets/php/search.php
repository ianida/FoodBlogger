<?php
session_start();

include('../../config.php');  // BASE_URL and config.
include('../../assets/php/connection.php');  // $conn database connection

if (!$conn) {
    die('Connection Error: ' . mysqli_connect_error());
}

function safeOutput($text)
{
    return htmlspecialchars($text);
}

// Helper to run prepared query with optional parameters
function runQuery($conn, $sql, $params = [], $types = "")
{
    $stmt = $conn->prepare($sql);
    if ($params) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    return $stmt->get_result();
}
?>

<html>

<head>
    <title>Result</title>
    <style>
        body {
            display: block;
            overflow-x: hidden;
        }

        img {
            position: relative;
            left: 10px;
            width: 200px;
            height: 140px;
            float: left;
            border: 1px solid black;
        }

        .product {
            position: relative;
            left: 20px;
        }

        @media only screen and (max-width: 700px) {
            .product h1 {
                font-size: 40px;
                left: 0px;
                padding-left: 25px;
            }

            .product p {
                font-size: 20px;
            }

            img {
                width: 300px;
                height: 200px;
            }
        }
    </style>
</head>

<body>

    <?php include('../../modules/navbar.php'); ?>

    <?php
    // Search by keyword
    if (isset($_GET['submit']) && isset($_GET['search'])) {
        $ser = trim($_GET['search']);
        $_SESSION['search'] = $ser;

        $likeSer = "%$ser%";
        $sql = "SELECT * FROM videos WHERE dname LIKE ?";
        $result = runQuery($conn, $sql, [$likeSer], "s");

        if ($result && $result->num_rows > 0) {
            echo "<h1>You are searching for: " . safeOutput(ucwords($ser)) . "</h1><hr>";
            while ($row = $result->fetch_assoc()) {
    ?>
                <br>
                <div class='product'>
                    <a style='text-decoration: none' href="<?php echo BASE_URL; ?>modules/video.php?p_id=<?php echo intval($row['id']); ?>">
                        <img src="<?php echo safeOutput($row['image']); ?>" alt="<?php echo safeOutput($row['dname']); ?>">
                        <h1>&ensp;<?php echo safeOutput($row['dname']); ?></h1>
                    </a>
                    <p>
                        <strong>&ensp;&ensp;&ensp;Description:</strong>
                        <?php echo safeOutput(base64_decode($row['description'])); ?><br><br>
                        &ensp;&ensp;&ensp;Uploaded by: <?php echo safeOutput($row['name']); ?>
                    </p>
                    <br>
                </div>
                <hr>
            <?php
            }
        } else {
            echo "<h3>No results found for '" . safeOutput($ser) . "'</h3>";
        }
    }

    // Search by cuisine
    if (isset($_GET['cusinav'])) {
        $cusinev = $_GET['cusinav'];

        $sql = "SELECT * FROM videos WHERE cusine = ?";
        $result = runQuery($conn, $sql, [$cusinev], "s");

        if ($result && $result->num_rows > 0) {
            echo "<h1>" . safeOutput(ucwords($cusinev)) . " Cuisines</h1><hr>";
            while ($row = $result->fetch_assoc()) {
            ?>
                <div class='product'>
                    <a style='text-decoration: none' href="<?php echo BASE_URL; ?>modules/video.php?p_id=<?php echo intval($row['id']); ?>">
                        <img src="<?php echo safeOutput($row['image']); ?>" alt="<?php echo safeOutput($row['dname']); ?>">
                        <h1>&ensp;<?php echo safeOutput($row['dname']); ?></h1>
                    </a>
                    <p>
                        <strong>&ensp;&ensp;&ensp;Description:</strong>
                        <?php echo safeOutput(base64_decode($row['description'])); ?><br><br>
                        &ensp;&ensp;&ensp;Uploaded by: <?php echo safeOutput($row['name']); ?>
                    </p>
                    <br>
                </div>
                <hr>
            <?php
            }
        } else {
            echo "<h3>No videos found for cuisine '" . safeOutput($cusinev) . "'</h3>";
        }
    }

    // Search by course
    if (isset($_REQUEST['navval'])) {
        $navval = $_REQUEST['navval'];

        $sql = "SELECT * FROM videos WHERE course = ?";
        $result = runQuery($conn, $sql, [$navval], "s");

        if ($result && $result->num_rows > 0) {
            echo "<h1>" . safeOutput(ucwords($navval)) . "s</h1><hr>";
            while ($row = $result->fetch_assoc()) {
            ?>
                <a style="text-decoration: none" href="<?php echo BASE_URL; ?>modules/video.php?p_id=<?php echo intval($row['id']); ?>">
                    <img src="<?php echo safeOutput($row['image']); ?>" alt="<?php echo safeOutput($row['dname']); ?>">
                </a>
                <div class='product'>
                    <a href="<?php echo BASE_URL; ?>modules/video.php?p_id=<?php echo intval($row['id']); ?>">
                        <h1><?php echo safeOutput($row['dname']); ?></h1>
                    </a>
                    <p>
                        <strong>Description:</strong>&ensp;<?php echo safeOutput(base64_decode($row['description'])); ?><br><br>
                        Uploaded by: <?php echo safeOutput($row['name']); ?>
                    </p>
                </div>
                <hr>
    <?php
            }
        } else {
            echo "<h3>No videos found for course '" . safeOutput($navval) . "'</h3>";
        }
    }
    ?>

</body>

</html>