<?php
$error = false;
$md5 = false;
$code = "";
if ( isset($_GET['code']) ) {
    $code = str_replace('"', '', $_GET['code']);
    if ( strlen($code) != 4 ) {
        $error = "Input must be exactly four characters";
    } else if (!ctype_digit($code)) {
        $error = "Input must numeric";
    } else {
        $md5 = hash('md5', $code);
    }
}
?>
<!DOCTYPE html>
<head><title>Tung Le PIN Code</title></head>
<body>
<h1>MD5 PIN Maker</h1>
<?php
if ( $error !== false ) {
    print '<p style="color:red">';
    print htmlentities($error);
    print "</p>\n";
}

if ( $md5 !== false ) {
    print "<p>MD5 value: ".htmlentities($md5)."</p>";
}
?>
<form>
<input type="text" name="code" value="<?= htmlentities($code) ?>"/>
<input type="submit" value="Compute MD5 for PIN"/>
</form>
<p><a href="makecode.php">Reset</a></p>
<p><a href="index.php">Back to Cracking</a></p>
</body>
</html>
