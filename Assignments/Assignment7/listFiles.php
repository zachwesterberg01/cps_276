<?php
require_once('php/listFilesProc.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>List Files</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h1 class="mb-3">List Files</h1>

    <a href="index.php" class="d-block mb-3">Add File</a>

    <?php echo $output; ?>

</body>
</html>