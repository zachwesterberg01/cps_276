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

/*
1.) The assignment specifies that "all PHP written at the top above the HTML Doctype". Explain the implications of this placement on how the server processes the page. What advantage does generating 
    all PHP variables ($evenNumbers, $form, $table) before any HTML output provide in terms of execution flow?
2.) Beyond simply finding even numbers, describe a scenario where you would use a similar foreach loop with a conditional (if) statement to filter or process elements from an array based on different 
    criteria like finding all numbers divisiable by 7
3.) Discuss the primary benefits of using heredoc for embedding large blocks of HTML or other text within PHP strings, especially when that text contains quotes or multiple lines. 
    How does it improve code readability compared to concatenating strings with double quotes?
4.) The createTable function uses nested for loops to build the table. Describe the role of each loop: which one is responsible for iterating through the rows, and which for the columns?
    How does the concatenation (.=) inside these loops incrementally build the complete HTML table string?
5.) The createTable() function returns a string that is later echoed, rather than echoing directly inside the function. Explain the benefits of this approach. 
    How does returning a value make the function more reusable and flexible compared to having the function echo directly? What are the implications for testing or reusing this function in different contexts?

*/
