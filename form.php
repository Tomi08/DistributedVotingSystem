<!DOCTYPE html>
<html>
<head>
    <title>Kérdőív</title>
</head>
<body>
    <h1>Kérdőív</h1>
    <?php
    session_start();
    if (isset($_SESSION["errors"])) {
        foreach ($_SESSION["errors"] as $error) {
            echo "<p>$error</p>";
        }
        unset($_SESSION["errors"]);
    }
    ?>
    <form action="process.php" method="POST">
        <?php include "form_generator.php"; ?>
        <button type="submit">Küldés</button>
    </form>
</body>
</html>
