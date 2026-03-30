<?php

require_once(__DIR__ . '/../classes/Pdo_methods.php');

$output = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['fileName'])) {
        $output = "Please enter a file name.";
    }
    else if (!isset($_FILES['file']) || $_FILES['file']['error'] != 0) {
        $output = "Please select a PDF file to upload.";
    }
    else {

        $fileName = trim($_POST['fileName']);
        $file = $_FILES['file'];

        if ($file['size'] > 100000) {
            $output = "The file is too large. File must be under 100000 bytes.";
        }
        else if (mime_content_type($file['tmp_name']) != 'application/pdf') {
            $output = "Only PDF files are allowed.";
        }
        else {
            $path = "files/" . basename($file['name']);

            if (move_uploaded_file($file['tmp_name'], __DIR__ . "/../" . $path)) {

                $sql = "INSERT INTO files (file_name, file_path) VALUES (:fileName, :filePath)";

                $bindings = [
                    [':fileName', $fileName, 'str'],
                    [':filePath', $path, 'str']
                ];

                $pdo = new PdoMethods();
                $result = $pdo->otherBinded($sql, $bindings);

                if ($result == 'noerror') {
                    $output = "File uploaded successfully.";
                }
                else {
                    $output = "There was an error saving the file information to the database.";
                }
            }
            else {
                $output = "There was an error uploading the file.";
            }
        }
    }
}
?>