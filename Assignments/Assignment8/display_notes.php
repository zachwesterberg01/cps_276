<?php
require_once 'classes/Date_time.php';
$dt = new Date_time();
$notes = $dt->checkSubmit();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 8 - Display Notes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4" style="max-width: 800px;">
    <h1>Display Notes</h1>
    <a href="index.php">Add Note</a>

    <form action="" method="post" class="mt-3">
        <div class="form-group">
            <label for="begDate">Beginning Date</label>
            <input type="date" class="form-control" id="begDate" name="begDate">
        </div>

        <div class="form-group">
            <label for="endDate">Ending Date</label>
            <input type="date" class="form-control" id="endDate" name="endDate">
        </div>

        <button type="submit" name="getNotes" class="btn btn-primary">Get Notes</button>
    </form>

    <div class="mt-3">
        <?php echo $notes; ?>
    </div>
</div>
</body>
</html>