<?php
require_once "pdo.php";
if (!isset($_GET['name']) || strlen($_GET['name']) < 1) {
    die('Name parameter missing');
}

if (isset($_POST['Logout'])) {
    header('Location: index.php');
    return;
}

$failure = false;
$success = false;
if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
    if (strlen($_POST['make']) < 1) {
        $failure = "Make is required";
    } else {
        $year = str_replace('"', '', $_POST['year']);
        $mileage = str_replace('"', '', $_POST['mileage']);
        if (!ctype_digit($year) || !ctype_digit($mileage)) {
            $failure = "Mileage and year must be numeric";
        }
    }

    if ($failure === false) {
        try {
            $stmt = $pdo->prepare('INSERT INTO autos
                                    (make, year, mileage) VALUES ( :mk, :yr, :mi)');
            $stmt->execute(array(
                ':mk' => $_POST['make'],
                ':yr' => $_POST['year'],
                ':mi' => $_POST['mileage']
            ));

            $success = "Record inserted";
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error adding automobile: " . $e->getMessage();
        }
    }
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
        echo $_GET['name'];
        echo "</h1>";

        if ($failure !== false) {
            // Look closely at the use of single and double quotes
            echo ('<p style="color: red;">' . htmlentities($failure) . "</p>\n");
        }
        if ($success !== false) {
            // Look closely at the use of single and double quotes
            echo ('<p style="color: green;">' . htmlentities($success) . "</p>\n");
        }
        ?>
        <form method="post">
            <p>Make: <input type="text" name="make" size="40"></p>
            <p>Year: <input type="text" name="year"></p>
            <p>Mileage: <input type="text" name="mileage"></p>
            <input type="submit" value="Add">
            <input type="submit" name="Logout" value="Logout">
        </form>
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

    </div>
</body>

</html>