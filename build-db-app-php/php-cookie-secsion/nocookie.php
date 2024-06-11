<?php 
    ini_set('session.use_cookies', '0');
    ini_set('session.use_only_cookies', '0');
    ini_set('session.use_trans_sid', '1');

    session_start();
?>

<p><b>No Cookies for you!</b></p>

<?php 
    if (! isset($_SESSION['value']) ) {
        echo("<p>Session is empty</p>\n");
        $_SESSION['value'] = 0;
    } else if ($_SESSION['value'] <3) {
        $_SESSION['value'] = $_SESSION['value'] + 1;
        echo("<p> Added one \$_SESSION['value]=".$_SESSION['value']."</p>\n");
    } else {
        session_destroy();
        session_start();
        echo("<p>Session Restarted</p>\n");
    }
?>

<p><a href="nocookie.php">Click This Anchor Tag!</a></p>

<P><form action="nocookie.php" method="post">
    <input type="submit" name="click" value="Click this submit button!">
</form></P>
<p>Our Session ID is: <?php echo(session_id()); ?></p>
<pre>
    <?php print_r($_SESSION); ?>
</pre>