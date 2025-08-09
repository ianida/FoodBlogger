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
            background-color: #fafafa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            color: #333;
            overflow-x: hidden;
        }

        h1 {
            font-size: 2.5rem;
            color: #d32f2f;
            margin-bottom: 20px;
            font-weight: 700;
            text-align: center;
            text-transform: capitalize;
        }

        h3 {
            font-size: 1.5rem;
            color: #777;
            text-align: center;
            margin-top: 40px;
        }

        .product {
            background-color: white;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 20px;
            align-items: flex-start;
            transition: box-shadow 0.3s ease;
        }

        .product:hover {
            box-shadow: 0 10px 25px rgba(211, 47, 47, 0.3);
        }

        .product img {
            width: 250px;
            height: 160px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #d32f2f;
            flex-shrink: 0;
        }

        .product h1 {
            font-size: 1.8rem;
            margin: 0 0 10px 0;
            color: #d32f2f;
        }

        .product p {
            margin: 0.2rem 0;
            font-size: 1rem;
            line-height: 1.5;
            color: #555;
        }

        .product strong {
            color: #d32f2f;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        a:hover h1 {
            text-decoration: underline;
            color: #9b1c1c;
        }

        hr {
            max-width: 900px;
            margin: 20px auto;
            border: none;
            border-bottom: 1px solid #eee;
        }

        @media (max-width: 700px) {
            .product {
                flex-direction: column;
                align-items: center;
                padding: 15px;
            }

            .product img {
                width: 100%;
                height: auto;
                max-height: 220px;
            }

            .product h1 {
                font-size: 1.6rem;
                margin-top: 15px;
                text-align: center;
            }

            .product p {
                font-size: 1rem;
                text-align: center;
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
                <div class='product'>
                    <a href="<?php echo BASE_URL; ?>modules/video.php?p_id=<?php echo intval($row['id']); ?>">
                        <img src="<?php echo safeOutput($row['image']); ?>" alt="<?php echo safeOutput($row['dname']); ?>">
                    </a>
                    <div>
                        <a href="<?php echo BASE_URL; ?>modules/video.php?p_id=<?php echo intval($row['id']); ?>">
                            <h1><?php echo safeOutput($row['dname']); ?></h1>
                        </a>
                        <p><strong>Description:</strong> <?php echo safeOutput(base64_decode($row['description'])); ?></p>
                        <p>Uploaded by: <?php echo safeOutput($row['name']); ?></p>
                    </div>
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
                    <a href="<?php echo BASE_URL; ?>modules/video.php?p_id=<?php echo intval($row['id']); ?>">
                        <img src="<?php echo safeOutput($row['image']); ?>" alt="<?php echo safeOutput($row['dname']); ?>">
                    </a>
                    <div>
                        <a href="<?php echo BASE_URL; ?>modules/video.php?p_id=<?php echo intval($row['id']); ?>">
                            <h1><?php echo safeOutput($row['dname']); ?></h1>
                        </a>
                        <p><strong>Description:</strong> <?php echo safeOutput(base64_decode($row['description'])); ?></p>
                        <p>Uploaded by: <?php echo safeOutput($row['name']); ?></p>
                    </div>
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
                <div class='product'>
                    <a href="<?php echo BASE_URL; ?>modules/video.php?p_id=<?php echo intval($row['id']); ?>">
                        <img src="<?php echo safeOutput($row['image']); ?>" alt="<?php echo safeOutput($row['dname']); ?>">
                    </a>
                    <div>
                        <a href="<?php echo BASE_URL; ?>modules/video.php?p_id=<?php echo intval($row['id']); ?>">
                            <h1><?php echo safeOutput($row['dname']); ?></h1>
                        </a>
                        <p><strong>Description:</strong> <?php echo safeOutput(base64_decode($row['description'])); ?></p>
                        <p>Uploaded by: <?php echo safeOutput($row['name']); ?></p>
                    </div>
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
