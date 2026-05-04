<?php
$status = $_SESSION['status'] ?? '';

if ($status === 'admin') {
    $nav = <<<HTML
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=addContact">Add Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=deleteContacts">Delete Contact(s)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=addAdmin">Add Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=deleteAdmins">Delete Admin(s)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
HTML;
} else {
    $nav = <<<HTML
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=addContact">Add Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=deleteContacts">Delete Contact(s)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
HTML;
}
?>
