<?php
$output = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "processNames.php";
    $output = addClearNames();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Names</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

<h1 class="mb-3">Add Names</h1>

<form method="post">
    <div class="mb-3">
        <button type="submit" name="add" class="btn btn-primary me-2">Add Name</button>
        <button type="submit" name="clear" class="btn btn-primary">Clear Names</button>
    </div>

    <div class="mb-3">
        <label for="fullname" class="form-label">Enter Name</label>
        <input type="text" id="fullname" name="fullname" class="form-control">
    </div>

    <div class="mb-3">
        <label for="namelist" class="form-label">List of Names</label>
        <textarea id="namelist" name="namelist" class="form-control" style="height: 500px;"><?php echo $output; ?></textarea>
    </div>
</form>

</body>
</html>