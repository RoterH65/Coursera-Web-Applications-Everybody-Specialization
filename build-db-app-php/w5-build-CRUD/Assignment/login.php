<?php 
// Do not put any HTML above this line
session_start();
require_once "pdo.php";

if (isset($_POST['cancel'])) {
    // Redirect the browser to index.php
    header("Location: index.php");
    return;
}

if (isset($_POST['email']) && isset($_POST['pass'])) {
    $salt = 'XyZzy12*_';
    if (strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1) {
        $_SESSION['error'] = "User name and password are required";
        header("Location: login.php");
        return;
    } else {
        if (strpos($_POST['email'], '@') === false) {
            $_SESSION['error'] = "Email must have an at-sign (@)";
            header("Location: login.php");
            return;
        } else {
            $check = hash('md5', $salt . $_POST['pass']);
            $stmt = $pdo->prepare('SELECT user_id, name FROM users WHERE email = :em AND password = :pw');
            $stmt->execute(array(':em' => $_POST['email'], ':pw' => $check));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row !== false) {
                error_log("Login success " . $_POST['email']);
                $_SESSION['name'] = $row['name'];
                $_SESSION['user_id'] = $row['user_id'];
                // Redirect the browser to index.php
                $_SESSION['login'] = true;
                header("Location: index.php");
                return;
            } else {
                error_log("Login fail " . $_POST['email'] . " $check");
                $_SESSION['error'] = "Incorrect password";
                header("Location: login.php");
                return;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php require_once "bootstrap.php"; ?>
    <title>95e61034 Tung Le's Login Page</title>
    <script>
        function doValidate() {
            console.log('Validating...');
            try {
                pw = document.getElementById('id_1723').value;
                console.log("Validating pw=" + pw);
                if (pw == null || pw == "") {
                    alert("Both fields must be filled out");
                    return false;
                }
                return true;
            } catch (e) {
                return false;
            }
            return false;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Please Log In</h1>
        <?php
        if (isset($_SESSION['error'])) {
            echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
            unset($_SESSION['error']);
        }
        ?>
        <form method="POST">
            <label for="nam">Email</label>
            <input type="text" name="email" id="nam"><br />
            <label for="id_1723">Password</label>
            <input type="text" name="pass" id="id_1723"><br />
            <input type="submit" onclick="return doValidate();" value="Log In">
            <input type="submit" name="cancel" value="Cancel">
        </form>
    </div>
</body>
</html>
