<?php
require_once 'classes/Date_time.php';
$dt = new Date_time();
$message = $dt->checkSubmit();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 8 - Add Note</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4" style="max-width: 800px;">
    <h1>Add Note</h1>
    <a href="display_notes.php">Display Notes</a>

    <div class="mt-3">
        <?php echo $message; ?>
    </div>

    <form action="" method="post">
        <div class="form-group">
            <label for="dateTime">Date and Time</label>
            <input type="datetime-local" class="form-control" id="dateTime" name="dateTime">
        </div>

        <div class="form-group">
            <label for="note">Note</label>
            <textarea class="form-control" id="note" name="note" rows="10"></textarea>
        </div>

        <button type="submit" name="addNote" class="btn btn-primary">Add Note</button>
    </form>
</div>
</body>
</html>