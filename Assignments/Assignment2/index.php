<?php
$numbers = range(1, 50);
$evens = [];

foreach ($numbers as $n) {
    if ($n % 2 === 0) {
        $evens[] = $n;
    }
}

$evenNumbers = 'Even Numbers: ' . implode(' - ', $evens);

$form = <<<HTML
<form class="mb-4" action="#" method="post">
  <div class="mb-3">
    <label for="emailAddress" class="form-label">Email address</label>
    <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="name@example.com">
  </div>

  <div class="mb-3">
    <label for="exampleTextarea" class="form-label">Example textarea</label>
    <textarea class="form-control" id="exampleTextarea" name="exampleTextarea" rows="4"></textarea>
  </div>
</form>
HTML;

function createTable(int $rows, int $columns): string
{
    $table = '<table class="table table-bordered">';
    $table .= '<tbody>';

    for ($r = 1; $r <= $rows; $r++) {
        $table .= '<tr>';
        for ($c = 1; $c <= $columns; $c++) {
            $table .= '<td>' . "Row {$r}, Col {$c}" . '</td>';
        }
        $table .= '</tr>';
    }

    $table .= '</tbody>';
    $table .= '</table>';
    return $table;
}

$table = createTable(8, 6);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Assignment 2</title>
</head>
<body class="container">
<?php
echo $evenNumbers;
echo $form;
echo $table;
?>
</body>
</html>
