<?php

require_once(__DIR__ . '/../classes/Pdo_methods.php');

$pdo = new PdoMethods();
$sql = "SELECT file_name, file_path FROM files";
$records = $pdo->selectNotBinded($sql);

$output = "";

if ($records == 'error') {
    $output = "There was an error retrieving the files.";
}
else if (count($records) == 0) {
    $output = "No files found.";
}
else {
    $output .= "<ul>";

    foreach ($records as $row) {
        $fileName = htmlspecialchars($row['file_name']);
        $filePath = htmlspecialchars($row['file_path']);

        $output .= "<li><a target='_blank' href='{$filePath}'>{$fileName}</a></li>";
    }

    $output .= "</ul>";
}
?>