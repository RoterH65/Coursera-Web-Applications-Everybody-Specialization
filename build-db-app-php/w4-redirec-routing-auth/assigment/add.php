<?php
require_once "pdo.php";
session_start();
require_once "pdo.php";
if (!isset($_SESSION['name'])) {
    die('Not logged in');
}

if(isset($_POST['Logout'])) {
    header("Location: logout.php");
    return;
}

if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
    if (strlen($_POST['make']) < 1) {
        $_SESSION['error'] = "Make is required";
        header("Location: add.php");
        return;
    } else {
        $year = str_replace('"', '', $_POST['year']);
        $mileage = str_replace('"', '', $_POST['mileage']);
        if (!ctype_digit($year) || !ctype_digit($mileage)) {
            $_SESSION['error'] = "Mileage and year must be numeric";
            header("Location: add.php");
            return;
        }
    }

    if (!isset($_SESSION['error'])) {
        try {
            $stmt = $pdo->prepare('INSERT INTO autos
                                    (make, year, mileage) VALUES ( :mk, :yr, :mi)');
            $stmt->execute(array(
                ':mk' => $_POST['make'],
                ':yr' => $_POST['year'],
                ':mi' => $_POST['mileage']
            ));
            $_SESSION['success'] = "Record inserted";
            header("Location: view.php");
            return;
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
        echo htmlentities($_SESSION['name']);
        echo "</h1>";

        if (isset($_SESSION['error'])) {
            echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
            unset($_SESSION['error']);
        }
        ?>
        <form method="post">
            <p>Make: <input type="text" name="make" size="40"></p>
            <p>Year: <input type="text" name="year"></p>
            <p>Mileage: <input type="text" name="mileage"></p>
            <input type="submit" value="Add">
            <input type="submit" name="Logout" value="Logout">
        </form>
    </div>
</body>

</html>