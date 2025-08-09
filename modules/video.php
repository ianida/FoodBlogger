<?php
session_start();
include_once(__DIR__ . '/../config.php');
include_once(__DIR__ . '/../assets/php/connection.php');

if (!isset($_SESSION['emailid'])) {
    header("Location: " . BASE_URL . "modules/login.php");
    exit;
}

$pid = isset($_REQUEST['p_id']) ? intval($_REQUEST['p_id']) : 0;
if ($pid <= 0) {
    echo "Invalid video ID.";
    exit;
}
$_SESSION['pid'] = $pid;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Video</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <style>
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 ratio */
            padding-top: 25px;
            height: 0;
        }
        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: black;
        }
        .section-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
    </style>

    <!-- jQuery & Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            var commentCount = 2;
            var commentCurrentCount = 0;
            var commentid = <?php echo $pid; ?>;
            $("#showmore").click(function() {
                commentCount += 2;
                commentCurrentCount += 2;
                $(".comment").load("<?php echo BASE_URL; ?>assets/php/load-comments.php", {
                    commentnewCount: commentCount,
                    commentCurrentCount: commentCurrentCount,
                    commentid: commentid
                });
            });
        });
    </script>
</head>
<body>
    <?php include(__DIR__ . '/navbar.php'); ?>

    <div class="container mt-4">
        <?php
        if (!$conn) {
            die('Connection Error: ' . mysqli_connect_error());
        }

        $qry = "SELECT * FROM videos WHERE id = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("i", $pid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
        ?>
            <!-- Video Section -->
            <div class="section-card">
                <h3 class="mb-3"><?php echo htmlspecialchars($row['dname']); ?></h3>
                <div class="video-container">
                    <video controls src="<?php echo htmlspecialchars(trim($row['videol'])); ?>"></video>
                </div>
            </div>

            <!-- Recipe Section -->
            <div class="section-card">
                <h4>Recipe</h4>
                <p><?php echo nl2br(htmlspecialchars(base64_decode($row['recepie']))); ?></p>
            </div>

            <!-- Description Section -->
            <div class="section-card">
                <h4>Description</h4>
                <p><?php echo nl2br(htmlspecialchars(base64_decode($row['description']))); ?></p>
            </div>

            <!-- Comments Section -->
            <div class="section-card">
                <h4>Comments</h4>
                <hr>

                <?php
                $sql = "SELECT * FROM comments WHERE p_id = ? LIMIT 2";
                $stmtComments = $conn->prepare($sql);
                $stmtComments->bind_param("i", $pid);
                $stmtComments->execute();
                $resultComments = $stmtComments->get_result();

                if ($resultComments && $resultComments->num_rows > 0) {
                    while ($commentRow = $resultComments->fetch_assoc()) {
                        echo '<p class="mb-1">' . htmlspecialchars(base64_decode($commentRow['comment'])) . '</p>';
                        echo '<small class="text-muted">- ' . htmlspecialchars($commentRow['author']) . '</small>';
                        echo '<hr>';
                    }
                } else {
                    echo '<p>No comments yet.</p>';
                }
                $stmtComments->close();
                ?>
                <div class="comment"></div>
                <button class="btn btn-outline-danger btn-sm float-right" id="showmore">Show More Comments</button>
                <div class="clearfix mb-3"></div>

                <!-- Add Comment Form -->
                <form action="<?php echo BASE_URL; ?>assets/php/store-comments.php" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Write a comment..." name="addcomment" required>
                        <div class="input-group-append">
                            <button class="btn btn-danger" type="submit">Comment</button>
                        </div>
                    </div>
                </form>
            </div>
        <?php
        } else {
            echo "<p>Video not found.</p>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>

    <!-- <?php //include(__DIR__ . '/footer.php'); ?> -->
</body>
</html>
