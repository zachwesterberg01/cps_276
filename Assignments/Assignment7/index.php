<?php
require_once('php/fileUploadProc.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h1 class="mb-3">File Upload</h1>

    <a href="listFiles.php" class="d-block mb-3">Show File List</a>

    <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="fileName" class="form-label">File Name</label>
            <input type="text" name="fileName" id="fileName" class="form-control">
        </div>

        <div class="mb-3">
            <input type="file" name="file" id="file" class="form-control">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Upload File</button>
    </form>

    <div class="mt-3">
        <?php echo $output; ?>
    </div>

</body>
</html>