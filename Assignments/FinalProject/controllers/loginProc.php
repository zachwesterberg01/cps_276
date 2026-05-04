<?php
require_once 'classes/Pdo_methods.php';

$message = "<p></p>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $pdo = new PdoMethods();

    $sql = "SELECT * FROM admins WHERE email = :email";
    $bindings = [
        [':email', $email, 'str'],
    ];

    $records = $pdo->selectBinded($sql, $bindings);

    if ($records === 'error' || count($records) === 0) {
        $message = "<p style='color:red'>Invalid email or password.</p>";
    }
    else {
        $admin = $records[0];

        if (password_verify($password, $admin['password'])) {
            $_SESSION['access'] = true;
            $_SESSION['name']   = $admin['name'];
            $_SESSION['status'] = $admin['status'];
            $_SESSION['email']  = $admin['email'];

            header('Location: index.php?page=welcome');
            exit;
        }
        else {
            $message = "<p style='color:red'>Invalid email or password.</p>";
        }
    }
}
?>
