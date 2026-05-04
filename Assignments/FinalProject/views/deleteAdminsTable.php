<?php
require_once 'controllers/deleteAdminProc.php';

function init() {
    global $records, $msg, $deleted;

    if ($records === 'error' || count($records) === 0) {
    $output = "<p><strong>There are no records to display</strong></p>";
    if (!$deleted) {
        $msg = "<p>&nbsp;</p>";
    } else {
        $msg = "<p style='color:green'>Admin(s) deleted</p>";
    }
    }
    else {
        $output = <<<HTML
<form method='post' action='index.php?page=deleteAdmins'>
    <input type='submit' class='btn btn-danger mb-3' name='delete' value='Delete'/>
    <table class='table table-striped table-bordered'>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
HTML;

        foreach ($records as $row) {
            $nameParts = explode(' ', $row['name'], 2);
            $firstName = $nameParts[0] ?? '';
            $lastName  = $nameParts[1] ?? '';

            $output .= "<tr>
                <td>{$firstName}</td>
                <td>{$lastName}</td>
                <td>{$row['email']}</td>
                <td>{$row['password']}</td>
                <td>{$row['status']}</td>
                <td><input type='checkbox' name='chkbx[]' value='{$row['id']}'/></td>
            </tr>";
        }

        $output .= "</tbody></table></form>";

        if ($records === 'error') {
            $msg = "<p style='color:red'>Could not display records.</p>";
        }
        else {
            if (!$deleted) {
                $msg = "<p>&nbsp;</p>";
            }
            else {
                $msg = "<p style='color:green'>Admin(s) deleted</p>";
            }
        }
    }

    return <<<HTML
<h1>Delete Admin(s)</h1>
{$msg}
{$output}
HTML;
}
?>
