<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MD5 cracker Tung Le</title>
</head>

<body>
    <h1>MD5 cracker</h1>
    <p>This application takes an MD5 hash of a four digit pin and check all 10,000 possible four digit PINs to determine the PIN.</p>
    <pre>
Debug Output:
<?php
$goodtext = "Not found";
if (isset($_GET['md5'])) {
    $time_pre = microtime(true);
    $md5 = $_GET['md5'];

    $txt = "0123456789";
    $show = 15;
    $total_check = 0;

    for ($i_0 = 0; $i_0 < strlen($txt); $i_0++) {
        $ch1 = $txt[$i_0];
        for ($i_1 = 0; $i_1 < strlen($txt); $i_1++) {
            $ch2 = $txt[$i_1];
            for ($i_2 = 0; $i_2 < strlen($txt); $i_2++) {
                $ch3 = $txt[$i_2];
                for ($i_3 = 0; $i_3 < strlen($txt); $i_3++) {
                    $ch4 = $txt[$i_3];

                    $try = $ch1 . $ch2 . $ch3 . $ch4;

                    $check = hash('md5', $try);
                    $total_check += 1;
                    if ($check == $md5) {
                        $goodtext = $try;
                        break;
                    }

                    if ($show > 0) {
                        print "$check $try \n";
                        $show = $show - 1;
                    }
                }
            }
        }
    }

    $time_post = microtime(true);
    print "Total checks: ";
    print $total_check;
    print "\n";
    print "Ellapsed time: ";
    print $time_post - $time_pre;
    print "\n";
}
?>
    </pre>
    <p>PIN: <?= htmlentities($goodtext); ?></p>
    <form>
        <input type="text" name="md5" size="60" />
        <input type="submit" value="Crack MD5" />
    </form>
    <ul>
        <li><a href="index.php">Reset this page</a></li>
        <li><a href="makecode.php">Make an MD5 PIN</a></li>
        <li><a href="md5.php">MD5 Encoder</a></li>
        <li><a href="https://www.wa4e.com/assn/crack/">Specification for this assignment</a></li>
        <li><a href="https://github.com/csev/wa4e/tree/master/code/crack" target="_blank">Source code for this application</a></li>
    </ul>
</body>

</html>