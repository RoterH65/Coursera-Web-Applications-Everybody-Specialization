<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tung Le PHP</title>
</head>
<body>  
    <h1><?php echo "Tung Le PHP";?></h1>

    <p>
        <?php
            $name = "Tung Le";
            $hash = hash('SHA256',$name);
            echo "The SHA256 hash of \"Tung Le\" is $hash";
        ?>
    </p>
    <pre>ASCII ART:

    ***********
    **       **
    **  
    **
    **
    **       **
    ***********</pre>

    <a href="check.php">Click here to check the error setting</a>
    <br>
    <a href="fail.php">Click here to cause a traceback</a>
</body>
</html>
