<?php
$path    = "index.php?page=login";
$content = "";


$publicPages = ['login', 'logout'];

$page = $_GET['page'] ?? 'login';


if (!in_array($page, $publicPages)) {
    require_once 'includes/security.php';
}

if ($page === 'login') {
    require_once 'views/loginForm.php';
    $content = init();
}

else if ($page === 'welcome') {
    require_once 'views/welcome.php';
    $content = init();
}

else if ($page === 'addContact') {
    require_once 'views/addContactForm.php';
    $content = init();
}

else if ($page === 'deleteContacts') {
    require_once 'views/deleteContactsTable.php';
    $content = init();
}

else if ($page === 'addAdmin') {
    require_once 'views/addAdminForm.php';
    $content = init();
}

else if ($page === 'deleteAdmins') {
    require_once 'views/deleteAdminsTable.php';
    $content = init();
}

else if ($page === 'logout') {
    require_once 'views/logout.php';
    $content = init();
}

else {
    header('Location: ' . $path);
    exit;
}
?>
