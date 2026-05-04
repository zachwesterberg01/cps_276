<?php
require_once 'controllers/loginProc.php';

function init() {
    global $message;

    return <<<HTML
<h1>Login</h1>
{$message}
<form method="post" action="index.php?page=login">
    <div class="mb-3">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email"
               value="">
    </div>
    <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
HTML;
}
?>
