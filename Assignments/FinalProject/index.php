<?php
session_start();

$page = $_GET['page'] ?? 'login';

require_once 'includes/navigation.php';
require_once 'routes/router.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Contacts Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <?php
    if (isset($_SESSION['access']) && $_SESSION['access'] === true) {
        echo $nav;
    }
    echo $content;
    ?>
</div>
</body>
</html>
