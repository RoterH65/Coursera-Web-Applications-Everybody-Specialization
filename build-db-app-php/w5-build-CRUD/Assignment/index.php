<?php
session_start();
require_once "pdo.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>95e61034 Tung Le - Broken Rock Paper Scissors</title>
    <?php require_once "bootstrap.php"; ?>
</head>

<body>
    <div class="container">
        <h1>Welcome to Autos Database</h1>
        <?php
        if (!isset($_SESSION['login'])) {
            echo '
            <p>
            <a href="login.php">Please Log In</a>
            </p>
            <p>Attempt to
                <a href="add.php">add.php</a> without logging in
            </p>';
            
        } else {
            if (isset($_SESSION['error'])) {
                echo '<p style="color:red">' . $_SESSION['error'] . "</p>\n";
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo '<p style="color:green">' . $_SESSION['success'] . "</p>\n";
                unset($_SESSION['success']);
            }

            $stmt = $pdo->query("SELECT autos_id, make, model, year, mileage FROM autos");
            if ($stmt->rowCount() > 0) {
                echo ('<table border="1">' . "\n");
                    echo "<tr><th>";
                    echo "Make";
                    echo "</th><th>";
                    echo "Model";
                    echo "</th><th>";
                    echo "Year";
                    echo "</th><th>";
                    echo "Mileage";
                    echo "</th><th>";
                    echo "Action";
                    echo "</th></tr>";
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr><td>";
                    echo (htmlentities($row['make']));
                    echo ("</td><td>");
                    echo (htmlentities($row['model']));
                    echo ("</td><td>");
                    echo (htmlentities($row['year']));
                    echo ("</td><td>");
                    echo (htmlentities($row['mileage']));
                    echo ("</td><td>");
                    echo ('<a href="edit.php?autos_id=' . $row['autos_id'] . '">Edit</a> / ');
                    echo ('<a href="delete.php?autos_id=' . $row['autos_id'] . '">Delete</a>');
                    echo ("</td></tr>\n");
                }
                echo ' </table>';
            } else {
                echo '<p>No rows found</p>';
            }
            echo '<p><a href="add.php">Add New Entry</a><br></p>';
            echo '<p><a href="logout.php">Logout</a></p>';
        }
        ?>

    </div>
</body>
