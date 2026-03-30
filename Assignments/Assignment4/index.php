<?php
require_once "Calculator.php";

$Calculator = new Calculator();

$result="";

$result .= $Calculator->calc("*", 10, 2);
$result .= $Calculator->calc("*", 4.56, 2);
$result .= $Calculator->calc("/", 10, 2);
$result .= $Calculator->calc("/", 10, 3);
$result .= $Calculator->calc("/", 10, 0);
$result .= $Calculator->calc("/", 0, 10);
$result .= $Calculator->calc("-", 10, 2);
$result .= $Calculator->calc("-", 10, 20);
$result .= $Calculator->calc("+", 10.5, 2);
$result .= $Calculator->calc("+", 10.5, 0);

$result .= $Calculator->calc("=", 10);
$result .= $Calculator->calc("a", 10);
$result .= $Calculator->calc("*", 10, "");
$result .= $Calculator->calc(10);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Assignment 4 - Calculator</title>
</head>
<body>
  <h1>Calculator Output</h1>
  <main>
    <?php echo $result ?>
  </main>
</body>
</html>

/*
1.) Explain the purpose of require_once "Calculator.php"; in th index.php page. What would be the difference if include or require were used instead of require_once?
2.) How does the divide method specifically prevent and report an error for division by zero? Why is this a critical consideration in calculator applications?
3.) Explain the difference between the Calculator class and the $Calculator object. Why do we create an instance of the class?
4.) Why is it important to check that the last two parameters are numbers in our Calculator class?
5.) Index.php handles the display of the results using HTML, while Calculator.php contains the core calculation logic. Discuss the importance of separating user interface (presentation) concerns from business logic.
*/