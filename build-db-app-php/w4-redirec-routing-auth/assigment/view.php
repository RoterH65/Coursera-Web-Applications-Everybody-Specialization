<?php
session_start();
require_once "pdo.php";
if (!isset($_SESSION['name'])) {
    die('Not logged in');
}

?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once "bootstrap.php"; ?>
    <title>95e61034 Tung Le's Autos Page</title>
</head>

<body>
    <div class="container">
        <?php
        echo "<h1>";
        echo 'Tracking Autos for ';
        echo htmlentities($_SESSION['name']);
        echo "</h1>";

        if ( isset($_SESSION['success']) ) {
            echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
            unset($_SESSION['success']);
        }        
        ?>
        <?php
        echo "<h1>";
        echo 'Automobiles';
        echo "</h1>\n";
        ?>
        <ul>
            <?php
            $stmt = $pdo->query("SELECT make,year,mileage FROM autos");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>";
                echo ($row['year']);
                echo ' ';
                // echo "<b>";
                echo htmlentities($row['make']);
                // echo "</b>";
                echo ' / ';
                echo ($row['mileage']);
                echo ("</li>\n");
            }
            ?>
        </ul>
        <p><a href="add.php">Add New</a> | <a href="logout.php">Logout</a></p>
    </div>
</body>

</html>