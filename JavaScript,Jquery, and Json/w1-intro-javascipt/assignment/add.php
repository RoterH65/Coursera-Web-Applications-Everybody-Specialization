<?php
require_once "pdo.php";
session_start();
if (!isset($_SESSION['name'])) {
    die("ACCESS DENIED");
}

if(isset($_POST['cancel'])) {
    header("Location: index.php");
    return;
}

if (
    isset($_POST['make']) && isset($_POST['model'])
    && isset($_POST['year']) && isset($_POST['mileage'])
) {
    // Data validation
    if (strlen($_POST['make']) < 1 || strlen($_POST['model']) < 1 || strlen($_POST['year']) < 1 || strlen($_POST['mileage']) < 1) {
        $_SESSION['error'] = 'All fields are required';
        header("Location: add.php");
        return;
    }

    if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
        $_SESSION['error'] = 'Year must be an integer';
        header("Location: add.php");
        return;
    }

    $stmt = $pdo->prepare('INSERT INTO Profile
        (user_id, first_name, last_name, email, headline, summary)
        VALUES ( :uid, :fn, :ln, :em, :he, :su)');
    $stmt->execute(array(
        ':uid' => $_SESSION['user_id'],
        ':fn' => $_POST['first_name'],
        ':ln' => $_POST['last_name'],
        ':em' => $_POST['email'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summary'])
    );
    $_SESSION['success'] = 'Record added';
    header('Location: index.php');
    return;
}

// Flash pattern

?>
<html>

<head>
    <?php require_once "bootstrap.php"; ?>
    <title>95e61034 Tung Le - Broken Rock Paper Scissors</title>
</head>

<body>
    <div class="container">
        <?php
        echo "<h1>";
        echo 'Tracking Automobiles for ';
        echo htmlentities($_SESSION['name']);
        echo "</h1>\n";
        if (isset($_SESSION['error'])) {
            echo '<p style="color:red">' . htmlentities($_SESSION['error']) . "</p>\n";
            unset($_SESSION['error']);
        }
        ?>
        <form method="post">
            <p>Make:
                <input type="text" name="make">
            </p>
            <p>Model:
                <input type="text" name="model">
            </p>
            <p>Year:
                <input type="text" name="year">
            </p>
            <p>Mileage:
                <input type="text" name="mileage">
            </p>
            <input type="submit" value="Add New" />
            <input type="submit" value="Cancel" name="cancel">
        </form>
    </div>
</body>

</html>