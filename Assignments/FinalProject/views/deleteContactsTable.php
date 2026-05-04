<?php
require_once 'controllers/deleteContactProc.php';

function init() {
    global $records, $msg, $deleted;

    if ($records === 'error' || count($records) === 0) {
    $output = "<p><strong>There are no records to display</strong></p>";
    if (!$deleted) {
        $msg = "<p>&nbsp;</p>";
    } else {
        $msg = "<p style='color:green'>Contact(s) deleted</p>";
    }
    }
    else {
        $output = <<<HTML
<form method='post' action='index.php?page=deleteContacts'>
    <input type='submit' class='btn btn-danger mb-3' name='delete' value='Delete'/>
    <table class='table table-striped table-bordered'>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Phone</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Contact</th>
                <th>Age</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
HTML;

        foreach ($records as $row) {
            $output .= "<tr>
                <td>{$row['fname']}</td>
                <td>{$row['lname']}</td>
                <td>{$row['address']}</td>
                <td>{$row['city']}</td>
                <td>{$row['state']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['email']}</td>
                <td>{$row['dob']}</td>
                <td>{$row['contacts']}</td>
                <td>{$row['age']}</td>
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
                $msg = "<p style='color:green'>Contact(s) deleted</p>";
            }
        }
    }

    return <<<HTML
<h1>Delete Contact(s)</h1>
{$msg}
{$output}
HTML;
}
?>
