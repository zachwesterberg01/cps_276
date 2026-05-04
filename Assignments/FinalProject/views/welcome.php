<?php
function init() {
    $name = $_SESSION['name'] ?? '';
    return <<<HTML
<h1>Welcome Page</h1>
<p>Welcome {$name}</p>
HTML;
}
?>
