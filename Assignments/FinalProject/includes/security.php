<?php

if (!isset($_SESSION['access']) || $_SESSION['access'] !== true) {
    header('Location: index.php?page=login');
    exit;
}


$adminOnlyPages = ['addAdmin', 'deleteAdmins'];
$currentPage    = $_GET['page'] ?? '';

if ($_SESSION['status'] === 'staff' && in_array($currentPage, $adminOnlyPages)) {
    header('Location: index.php?page=welcome');
    exit;
}
?>
